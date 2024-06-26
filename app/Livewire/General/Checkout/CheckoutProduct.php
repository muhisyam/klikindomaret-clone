<?php

namespace App\Livewire\General\Checkout;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\General\CartController;
use App\Http\Controllers\Web\General\GeneralController;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutProduct extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public array $response       = [];
    public array $carts          = [];
    public array $otherInfo      = [];
    public array $pickedDelivery = [];
    public array $quantities     = [];

    public function __construct() 
    {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'carts/';
    }

    public function loadContent($rerendering = false)
    {
        $this->response       = $this->getDataUserCartProducts()['data'];
        $this->carts          = Arr::except($this->response, ['other_info']);
        $this->otherInfo      = $this->response['other_info'];
        $this->quantities     = $this->otherInfo['qty_product_each_supplier'];
        $this->pickedDelivery = $this->otherInfo['default_delivery_option'];
        
        $this->dispatchSummaryContent();

        if (! $rerendering) {
            $this->dispatch('run-js-content-loaded');
        }
    }

    private function getDataUserCartProducts()
    {
        $username  = session('user')['username'];
        $userToken = session('auth_token');

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $username,
                headers: [
                    'Authorization' => 'Bearer ' . $userToken
                ],
            )
        );
    }

    private function getTotalDeliveryPrice(array $deliveryOptions): int
    {
        $total = 0;

        foreach ($deliveryOptions as $option) {
            $total += $option['price'];
        }

        return $total;
    }


    private function dispatchSummaryContent()
    {
        return $this->dispatch('content-loaded', summary: [
            'total_delivery_price'   => $this->getTotalDeliveryPrice($this->pickedDelivery),
            'total_product_discount' => $this->otherInfo['total_product_discount'],
            'grand_total'            => $this->otherInfo['grand_total'],
        ]);
    }

    #[On('qty-content-changed')]
    public function updateQuantity($quantityChanged)
    {
        $index      = 0;
        $quantities = Arr::collapse($this->quantities);

        foreach ($quantities as $productSlug => $qty) {
            if ($qty != $quantityChanged[$index]) {
                $updateCart['product_slug'] = $productSlug;
                $updateCart['quantity']     = $quantityChanged[$index];
                $updateCart['_method']      = 'put';
                
                app(CartController::class)->update($updateCart);
            }

            $index++;
        }
        
        $this->loadContent(true);
    }

    #[On('set-picked-delivery-opt')]
    public function setDeliveryOpt(string $supplierName, string $deliveryOption, string $shippingCost, string $message)
    {
        $message = $this->getTimeOptionMessage($deliveryOption, $message);

        $this->pickedDelivery[$supplierName] = [
            'option'  => $deliveryOption,
            'price'   => (int) $shippingCost,
            'message' => $message,
        ];

        $this->dispatchSummaryContent();
    }

    private function getTimeOptionMessage(string $deliveryOption, string $message)
    {
        if($deliveryOption !== 'time') {
            return $message;
        }

        $arrMessage      = explode('|', $message);
        $deliveryDate    = parseToCarbon($arrMessage[0]);
        $today           = Carbon::today();
        $willBeDelivered = match ($deliveryDate->diffInDays($today)) {
            0 => 'Hari ini',
            1 => 'Besok',
            2 => formatToIdnLocale($deliveryDate, 'l'),
        };

        return $willBeDelivered . ', ' . $arrMessage[0] . ', ' . $arrMessage[1];
    }

    #[On('picked-up-in-store')]
    public function updateStoreDeliveryShippingPrice()
    {
        if (! isset($this->carts['Toko Indomaret'])) {
            return;
        }

        /**
         * Update select delivery option data price to 0, if user pickup method
         * is taken from store.
        */
        $deliveryOptions = $this->carts['Toko Indomaret']['additional_info']['delivery_options'];

        foreach ($deliveryOptions as $type => $option) {
            $deliveryOptions[$type]['price'] = 0;
        }

        $this->carts['Toko Indomaret']['additional_info']['delivery_options'] = $deliveryOptions;

        /**
         * Update data picked delivery option data price to 0 
        */
        $this->pickedDelivery['Toko Indomaret']['price'] = 0;
        
        $this->dispatchSummaryContent();
    }

    #[On('payment-success')]
    public function paymentOnSuccess(array $resultCallback)
    {   
        $dataChannel = app(OrderService::class)->getDataPayment($resultCallback);
        $dataPicked  = [
            '_method'       => 'put',
            'supplier'      => [],
            'option'        => [],
            'expected_time' => [],
            'price'         => [],
        ];

        foreach ($this->pickedDelivery as $supplierName => $value) {
            array_push($dataPicked['supplier'], $supplierName);
            array_push($dataPicked['option'], $value['option']);
            array_push($dataPicked['expected_time'], $value['message']);
            array_push($dataPicked['price'], $value['price']);
        }

        $params = array_merge($dataChannel, $dataPicked);

        app(GeneralController::class)->processOrder($params);
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-product');
    }
}
