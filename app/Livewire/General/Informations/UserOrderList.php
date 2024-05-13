<?php

namespace App\Livewire\General\Informations;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Component;

class UserOrderList extends Component
{
    protected object $clientAction;
    protected string $endpoint;
    
    public array $orders = [];

    public function __construct() 
    {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'orders/';
    }

    public function loadContent()
    {
        $this->orders = $this->getDataUserOrders()['data'];
    }

    private function getDataUserOrders()
    {
        $username  = session('user')['username'];
        $userToken = session('auth_token');

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $username . '?take_amount=5',
                headers: [
                    'Authorization' => 'Bearer ' . $userToken
                ],
            )
        );
    }

    public function openOrderModal(string $orderKey)
    {
        $this->dispatch('open-order-modal', orderKey: $orderKey);
    }

    public function render()
    {
        return view('livewire.general.informations.user-order-list');
    }
}
