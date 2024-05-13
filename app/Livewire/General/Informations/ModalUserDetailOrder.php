<?php

namespace App\Livewire\General\Informations;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalUserDetailOrder extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public bool $showCondition;
    public string $section;
    public array $order = [
        'order_key'         => null,
        'user_order_status' => 'settlement',
        'status_icon'       => 'settlement',
    ];

    public function __construct() 
    {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'orders/';
    }

    #[On('open-order-modal')]
    public function initModal(string $orderKey)
    {
        $this->order = $this->getDetailUserOrder($orderKey)['data'];
        $this->showCondition = true;
    }

    private function getDetailUserOrder(string $orderKey)
    {
        $username  = session('user')['username'];
        $userToken = session('auth_token');

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . $username . '/modal?order_key=' . $orderKey,
                headers: [
                    'Authorization' => 'Bearer ' . $userToken
                ],
            )
        );
    }

    public function render()
    {
        return view('livewire.general.informations.modal-user-detail-order');
    }
}
