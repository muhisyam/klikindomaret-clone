<?php  

namespace App\Services;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderRelationshipDeliveryResource;
use App\Models\Order;
use App\Models\Retailer;
use App\Models\Supplier;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class OrderService 
{
    public function __construct(
        protected ClientRequestAction $clientAction
    ) {}

    /**
     * Ensure user orders dont have "fresh" order which consist of orders that
     * do not have and have not yet completed payment. "Fresh" orders will update 
     * the data according to existing data at midtrans. If an order is not registered 
     * with Midtrans, it will be considered an ongoing order.
    */
    public function ensureDontHasFreshOrder(object $userOrders): bool
    {
        $doesntHasFreshOrder = true;

        if ($userOrders->isEmpty()) {
            return $doesntHasFreshOrder;
        }

        foreach ($userOrders as $order) {
            if (
                $order->user_order_status !== Order::$userStatus['create'] || 
                $order->user_order_status !== Order::$userStatus['pending']
            ) {
                continue;
            }

            $resultCallback = $this->getOrderDetailFromMidtrans($order->order_key);

            if ($resultCallback['status_code'] == 404) {
                continue;
            }

            $dataChannel = $this->getDataPayment($resultCallback);

            app(OrderController::class)->updateOnPending(
                user     : new User,
                request  : new Request,
                orderData: [
                    'user_order'     => $order,
                    'new_data_order' => $dataChannel,
                ],
            );

            $doesntHasFreshOrder = false;
        }

        return $doesntHasFreshOrder;
    }

    private function getOrderDetailFromMidtrans(string $orderId): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method  : 'GET',
                endpoint: config('midtrans.url.api') . $orderId . '/status',
                headers : [
                    'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key'))
                ],
            )
        );
    }

    /**
     * Get payment type, va number and order status from midtrans data callback.
    */
    public function getDataPayment(array $resultCallback): array
    {
        $paymentType = $resultCallback['payment_type'] == 'bank_transfer' ? $resultCallback['va_numbers'][0]['bank'] : $resultCallback['payment_type'];
        $vaNumber    = match ($resultCallback['payment_type']) {
            'bank_transfer' => $resultCallback['va_numbers'][0]['va_number'],
            'cstore'        => $resultCallback['payment_code'],
            default         => null,
        };

        return [
            'payment_channel' => $paymentType, 
            'va_number'       => $vaNumber,
            'order_status'    => $resultCallback['transaction_status'],
        ];
    }

    public function getDataPickupDateRelation(Request $request): array
    {
        $dataEachSupplier = [];
        $supplierIds      = Supplier::pluck('id', 'supplier_name');
        $suppliers        = $request['supplier'];
        $options          = $request['option'];
        $expectedTimes    = $request['expected_time'];

        for ($i = 0; $i < count($request['supplier']); $i++) {
            $currOption = $options[$i];
            $supplierId = $supplierIds[$suppliers[$i]] ?? $supplierIds['Indomaret'];

            $expectDate = match ($currOption) {
                'regular' => today()->addDays(3),
                'time'    => parseToCarbon($expectedTimes[$i]),
                default   => today(),
            };

            $expectTime = match ($currOption) {
                'time'    => explode('|', $expectedTimes[$i])[1],
                'express' => now()->addMinutes(15)->format('H.i') . ' - '. now()->addHour()->addMinutes(15)->format('H.i'),
                default   => null,
            };
            
            $dataEachSupplier[$supplierId] = [
                'delivery_option'       => $currOption,
                'expected_pickup_date'  => $expectDate,
                'expected_time_between' => $expectTime,
                'delivery_price'        => $request['price'][$i],
            ];
        }

        return $dataEachSupplier;
    }

    public function getPickupCode(int $length = 6, string $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    public function sanitizeGroupBy(object $userOrder): object
    {
        $supplierGroupedData = [
            'products'   => $userOrder->products,
            'deliveries' => $userOrder->deliveries,
        ];

        foreach ($supplierGroupedData as $keyName => $data) {
            $isHasFlagF          = collect($data['Indomaret'] ?? []);
            $isHasFlagT          = collect($data['Indomaret Fresh'] ?? []);
            $mergeSupplier       = ['Toko Indomaret' => $isHasFlagF->merge($isHasFlagT)];
            $mergeToResult       = collect($mergeSupplier)->merge(collect($data));
            $userOrder->$keyName = $mergeToResult->except(['Indomaret', 'Indomaret Fresh']);
        }

        return $userOrder;
    }

    public function getStatusIcon(string $orderStatus): string
    {
        return array_search($orderStatus, Order::$userStatus);
    }

    public function getPickupAddress(object $dataPlace): array
    {
        $detailAttr = $this->getDataAttributes($dataPlace);
        $dataRegion = $dataPlace['region'];

        return [
            'place_name'            => $dataPlace[$detailAttr['place_name']],
            'place_address'         => $dataPlace[$detailAttr['place_address']],
            'place_postal_code'     => $dataRegion['region_postal_code'],
            'longitude'             => $dataPlace['longitude'],
            'latitude'              => $dataPlace['latitude'],
            'reciever_name'         => $dataPlace[$detailAttr['reciever_name']],
            'reciever_phone_number' => $dataPlace[$detailAttr['reciever_phone_number']] ?? '-',
        ];
    }

    private function getDataAttributes(object $dataPlace): array
    {
        return match (get_class($dataPlace)) {
            Retailer::class => [
                'place_name'            => 'retailer_name',
                'place_address'         => 'retailer_address',
                'reciever_name'         => 'retailer_name',
                'reciever_phone_number' => null,
            ],
            UserAddress::class => [
                'place_name'            => 'address_label',
                'place_address'         => 'address_main',
                'reciever_name'         => 'reciever_name',
                'reciever_phone_number' => 'reciever_phone_number',
            ],
        };
    }

    public function getDataSanitizedProducts(object $dataProducts): array
    {
        $newArr = [];
        
        foreach ($dataProducts as $supplierName => $groupedBySupplier) {
            $newArr[$supplierName] = OrderProductResource::collection($groupedBySupplier);
        }
        
        return $newArr;
    }

    public function getDataSanitizedDeliveries(object $dataDeliveries): array
    {
        $newArr = [];
        
        foreach ($dataDeliveries as $supplierName => $groupedBySupplier) {
            /**
             * Should be pay attention, because the results of group by is a data collection 
             * for each supplier, so you have to select the first index array then select 
             * the pivot data to get supplier deliveries data.
            */
            $newArr[$supplierName] = new OrderRelationshipDeliveryResource($groupedBySupplier[0]->pivot);
        }
        
        return $newArr;
    }

    /**
     * Set supplier and retailer id for spesific product to be taken according
     * the retailer.
     * 
     * @param object $retailer
     * @return array [supplierId, retailerId]
    */
    public function setSupplierAndRetailerId(object $retailer): array
    {
        $suppliers  = Supplier::getStoreSupplier('id', 'supplier_name')->toArray();

        /**
         * If user retail is store supplier, it will store the store supp ids. If not 
         * it will store user retailer id and supp id. $retailerId is to get all product
         * that provide from the retailer.
        */
        return in_array($retailer->supplier_id, $suppliers) 
            ? [$suppliers, null] 
            : [[$retailer->supplier_id], $retailer->id];
    }
}