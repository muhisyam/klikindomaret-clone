<?php

namespace App\Livewire\General\Checkout;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\General\CartController;
use Livewire\Component;

class CheckoutProduct extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public mixed $products = [];
    public array $quantity = [];
    public array $subTotal = [];
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

    public function loadContent()
    {
        // TODO: fix this loop now
        $this->products = $this->getDataUserCartProducts()['data'];

        foreach ($this->products as $index => $product) {
            // This quantity prop, the key is the product slug 
            // then will be like --> $quantity = ['slug' => 'quantity', etc...]
            $this->quantity   = array_merge($this->quantity, [$product['product_slug'] => $product['quantity']]);

            // But in this prop the key is index of loop, not the product slug 
            // so you have to pay attention in blade view
            $this->subTotal[] = ($product['discount_price'] ?? $product['normal_price']) * $product['quantity'];
            $this->grandTotal += $this->subTotal[$index];
        }

        $this->dispatch('content-loaded');
    }

    public function updateQuantity($updateMethod, $productSlug)
    {
        $quantity = $this->quantity[$productSlug];

        if ($updateMethod == 'sub' && $quantity == 1) {
            return;
        }

        $quantity = match ($updateMethod) {
            'sub' => $quantity - 1,
            'add' => $quantity + 1,
        };

        $updateCart['product_slug'] = $productSlug;
        $updateCart['quantity']     = $quantity;
        $updateCart['_method']      = 'put';

        app(CartController::class)->update($updateCart);
        
        $this->reset('subTotal', 'grandTotal');
        $this->loadContent();
    }

    public function render()
    {
        // $this->products = $this->getDataUserCartProducts()['data'];

        return view('livewire.general.checkout.checkout-product');
    }
}
