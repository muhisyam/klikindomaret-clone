<?php 

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutService
{
    protected User $user;
    protected string $orderkey;
    protected object $userAddress;
    protected object $userPickupAddress;
    protected array $userCarts;

    public function getSnapToken(Request $request)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.env');
        Config::$isSanitized  = config('midtrans.sanitized');
        Config::$is3ds        = config('midtrans.3ds');

        $params = $this->setRequestBody();

        try {
            return Snap::getSnapToken($params);
        } catch (Exception $error) {
            $this->sendSnapTokenFailed($error);
        }
    }

    private function setRequestBody()
    {
        $params = [
            'transaction_details' => [
                'order_id'     => 'DEMO-' . rand(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'budi',
                'last_name'  => 'pratama',
                'email'      => 'budi.pra@example.com',
                'phone'      => '08111222333',
                "billing_address"=> [
                    "address"=> "Sudirman",
                    "city"=> "Jakarta",
                    "postal_code"=> "12190",
                    "country_code"=> "IDN"
                  ],
                "shipping_address"=> [
                    "first_name"=> "SHIPPING",
                    "last_name"=> "MIDTRANSER",
                    "phone"=> "0 8128-75 7-9338",
                    "address"=> "Cempaka",
                    "city"=> "Cilegon",
                    "postal_code"=> "12190",
                    "country_code"=> "IDN"
                ],
            ],
            'item_details' => [
                [
                    "id"            => "ITEM1",
                    "price"         => 2500,
                    "quantity"      => 2,
                    "name"          => "Midtrans Bear",
                ],
                [
                    "id"            => "ITEM2",
                    "price"         => 5000,
                    "quantity"      => 1,
                    "name"          => "Seller Bearbrand",
                ],
            ],
        ];

        return $params;
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