<?php

namespace App\Livewire\General\Checkout;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\General\CartController;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutProduct extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public array $carts          = [];
    public array $pickedDelivery = [];
    public array $quantities     = [];

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'carts/';
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

    public function loadContent($rerendering = false)
    {
        $this->carts      = $this->getDataUserCartProducts()['data'];
        $this->quantities = $this->carts['qty_product_each_retailer'];
        
        $this->dispatch('content-loaded', summary: [
            'total_product_discount' => $this->carts['total_product_discount'],
            'grand_total'            => $this->carts['grand_total'],
        ]);

        if (! $rerendering) {
            $this->dispatch('run-js-content-loaded');
        }

        $this->carts = Arr::except($this->carts, ['qty_product_each_retailer', 'total_product_discount', 'grand_total']);
    }

    #[On('qty-content-changed')]
    public function updateQuantity($quantityChanged)
    {
        $index = 0;
        $collapsedDataQtys = Arr::collapse($this->quantities);

        foreach ($collapsedDataQtys as $productSlug => $qty) {
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

    public function setDeliveryOpt(string $retailerName, string $deliveryOption, int $shippingCost)
    {
        $this->pickedDelivery[$retailerName] = [
            'option' => $deliveryOption,
            'price' => $shippingCost,
        ];
    }

    #[On('picked_up_in_store')]
    public function updateStoreDeliveryShippingPrice()
    {
        if (! isset($this->carts['Toko Indomaret'])) {
            return;
        }

        $deliveryOptions = $this->carts['Toko Indomaret']['delivery_options'];

        foreach ($deliveryOptions as $type => $option) {
            $deliveryOptions[$type]['price'] = 0;
        }

        $this->carts['Toko Indomaret']['delivery_options'] = $deliveryOptions;
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-product');
    }
}
