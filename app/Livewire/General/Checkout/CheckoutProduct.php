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

    public array $products = [];
    public array $quantity = [];
    public int $grandTotal = 0; 

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'carts/';
    }

    private function getDataUserCartProducts()
    {
        $userId    = session('user')['id'];
        $userToken = session('auth_token');

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $userId,
                headers: [
                    'Authorization' => 'Bearer ' . $userToken
                ],
            )
        );
    }

    public function loadContent($rerendering = false)
    {
        $this->products      = $this->getDataUserCartProducts()['data'];
        $eachProductDiscount = 0;

        foreach ($this->products as $retailerName => $productByGroup) {
            $this->quantity[$retailerName] = [];

            foreach ($productByGroup as $product) {
                // This quantity prop, grouped by supplier name then has the product inside it. The key each product using product slug. 
                // The prop will be like --> ['Warehouse' => ['product_slug' => 'quantity', etc...]]
                $this->quantity[$retailerName] = array_merge($this->quantity[$retailerName], [$product['product_slug'] => $product['quantity']]);
                $eachProductPrice              = $product['quantity'] * ($product['discount_price'] ?? $product['normal_price']);
                $eachProductDiscount          += $product['quantity'] * ($product['normal_price'] - ($product['discount_price'] ?? $product['normal_price']));
                $this->grandTotal             += $eachProductPrice;
            }
        }

        $this->dispatch('content-loaded', summary: [
            'grandTotal'          => $this->grandTotal,
            'eachProductDiscount' => $eachProductDiscount,
        ]);

        if (! $rerendering) {
            $this->dispatch('run-js-content-loaded');
        }
    }

    #[On('qty-content-changed')]
    public function updateQuantity($quantityChanged)
    {
        $index = 0;
        $collapsedDataQtys = Arr::collapse($this->quantity);

        foreach ($collapsedDataQtys as $productSlug => $qty) {
            if ($qty != $quantityChanged[$index]) {
                $updateCart['product_slug'] = $productSlug;
                $updateCart['quantity']     = $quantityChanged[$index];
                $updateCart['_method']      = 'put';
                
                app(CartController::class)->update($updateCart);
            }

            $index++;
        }
        
        $this->reset('grandTotal');
        $this->loadContent(true);
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-product');
    }
}
