<?php 

namespace App\Services;

use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\PickupMethodController;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutService
{
    protected array $userPickupAddress;
    protected array $userCarts;
    protected array $productIds = [];
    protected int $deliveryPrice;
    protected string $orderKey;
    protected string $pickupInfo;
    protected User $user;

    public function getSnapToken(Request $request)
    {
        $this->initGlobalData($request);

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.env');
        Config::$isSanitized  = config('midtrans.sanitized');
        Config::$is3ds        = config('midtrans.3ds');

        $params = $this->createRequestBody();

        try {
            return Snap::getSnapToken($params);
        } catch (Exception $error) {
            $this->sendSnapTokenFailed($error);
        }
    }

    /**
     * Cant pass request from parent to constructor
    */
    private function initGlobalData(Request $request)
    {
        $this->user           = $request->user();
        $this->deliveryPrice  = $request['delivery_price'];
        $this->userCarts      = app(CartController::class)->getUserCart($request);
        $pickupAddresses      = app(PickupMethodController::class)->getUserPickupData($request);
        $pickupAddresses      = Arr::except($pickupAddresses, ['is_picked_up_in_store', 'pickup_icon']);
        
        /**
         * Order key combination, consists of 3 digits of binary numbers. Each digit
         * will be true when supplier exists in cart. First digit is supplier store, 
         * second is warehouse, and last is seller.
        */
        $keySupplier  = '';
        $keySupplier .= array_key_exists('Toko Indomaret', $this->userCarts) ? '1' : '0';
        $keySupplier .= array_key_exists('Warehouse', $this->userCarts) ? '1' : '0';
        $keySupplier .= array_key_exists('Seller', $this->userCarts) ? '1' : '0';
        
        /**
         * One of order key combination. This value only "D" or "T". D is mean delivery to
         * user address. T is mean taken, when user pickup products in store.
        */
        $keyMethod     = '';
        $keyDate       = today()->format('ymd');
        $keyUsername   = strtoupper($this->user['username']);

        foreach ($pickupAddresses as $address) {
            if ($address['is_selected_method']) {
                $this->userPickupAddress = $address;
                $isPickedInStore         = $address['last_pickup_with_retailer'];
                $keyMethod               = $isPickedInStore ? 'T' : 'D';
                $this->pickupInfo        = $isPickedInStore ? 'taken' : 'delivered';
            }
        }

        $this->orderKey = $keyUsername . '-' . $keySupplier . '-' . $keyMethod . $keyDate;
    }

    private function createRequestBody()
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $this->orderKey,
                'gross_amount' => $this->userCarts['other_info']['grand_total'] + $this->deliveryPrice,
            ],
            'customer_details' => $this->setDataCustomer(),
            'item_details'     => $this->setDataItems(),
        ];

        return $params;
    }

    private function setDataCustomer()
    {
        $shippingDetail = $this->userPickupAddress['place_detail'];
        $userFullname   = explode(' ', $this->user['fullname'], 2);
        $recieverName   = explode(' ', $shippingDetail['reciever_name'], 2);
        $dataCustomer   = [
            'first_name' => $userFullname[0],
            'last_name'  => $userFullname[1],
            'email'      => $this->user['email'],
            'phone'      => $this->user['mobile_number'],
            'shipping_address' => [
                'first_name'   => $recieverName[0],
                'last_name'    => $recieverName[1],
                'phone'        => $shippingDetail['reciever_phone_number'],
                'address'      => $shippingDetail['place_address'],
                'city'         => $shippingDetail['place_location'],
                'postal_code'  => $shippingDetail['place_postal_code'],
                'country_code' => 'IDN'
            ],
        ];

        return $dataCustomer;
    }

    private function setDataItems()
    {
        $dataEachItem = [];
        $carts        = Arr::except($this->userCarts, 'other_info');

        foreach ($carts as $groupBySupplier) {
            $productSlugs     = Arr::pluck($groupBySupplier['products'], 'product_slug');
            $productIds       = Product::whereIn('product_slug', $productSlugs)->pluck('id')->toArray();
            $this->productIds = array_merge($this->productIds, $productIds);

            foreach ($groupBySupplier['products'] as $index => $product) {
                $dataEachItem = array_merge($dataEachItem, [
                    [
                        "id"       => $productIds[$index],
                        "price"    => $product['discount_price'] ?? $product['normal_price'],
                        "quantity" => $product['quantity'],
                        "name"     => $product['product_name'],
                    ]
                ]);
            }
        }
        
        $dataEachItem = array_merge($dataEachItem, [
            [
                "id"       => '-',
                "price"    => $this->deliveryPrice,
                "quantity" => 1,
                "name"     => 'Shipping Price',
            ]
        ]);

        return $dataEachItem;
    }

    private function createDataUserOrder()
    {
    }

    private function sendSnapTokenFailed(Exception $error)
    {
        $statusCode  = $error->getCode();
        $codeMessage = [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            500 => 'Internal Server Error',
        ];

        throw new HttpResponseException(
            response([
                'errors' => [
                    'message' => [
                        $error->getMessage(),
                    ],
                ],
                'meta' => [
                    'status_code' => $statusCode,
                    'message'     => $codeMessage[$statusCode],
                ],
            ])
            ->setStatusCode($statusCode)
        );
    }
}