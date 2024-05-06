<?php  

namespace App\Services;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Api\v1\OrderController;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;
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
            if ($order->user_order_status !== Order::$userStatus['create']) {
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
            ];
        }

        return $dataEachSupplier;
    }

    public function getPickupCode(int $length = 6, string $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}