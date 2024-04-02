<?php

namespace App\Livewire\General\Header;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public mixed $cartsCount = 0;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'carts';
    }
    private function getDataProduct()
    {
        // TODO: Fix this hard code
        $userId = session('user')['id'];

        return User::where('id', $userId)->withCount('carts')->first();
    }
    
    #[On('cart-updated')]
    public function render()
    {
        $this->cartsCount = $this->getDataProduct()->carts_count;

        return view('livewire.general.header.cart-icon');
    }
}
