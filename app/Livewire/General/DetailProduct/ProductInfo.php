<?php

namespace App\Livewire\General\DetailProduct;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Web\General\CartController;
use Livewire\Component;

class ProductInfo extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public string $section;
    public mixed $data = null;
    public int $quantity = 1;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'products/';
    }

    private function getDataProduct()
    {
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $this->section,
            )
        );

        return $response['data'];
    }

    public function loadContent()
    {
        $this->data = $this->getDataProduct();
        $this->dispatch('content-loaded');
    }

    public function toCart()
    {
        $cart['product_slug'] = $this->data['product_slug'];
        $cart['quantity']     = $this->quantity;

        $response = app(CartController::class)->store($cart);

        switch ($response['meta']['status_code']) {
            case 401:
                $this->dispatch('unauthenticated');
                break;

            case 409:
                session()->flash('failed', 'Produk sudah ada di keranjang');
                break;
            
            default:
                session()->flash('success', 'Produk berhasil ditambahkan');
                $this->dispatch('cart-updated');
                break;
        }
    }

    public function render()
    {
        return view('livewire.general.detail-product.product-info');
    }
}
