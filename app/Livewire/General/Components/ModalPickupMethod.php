<?php

namespace App\Livewire\General\Components;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Illuminate\Support\Arr;
use Livewire\Component;

class ModalPickupMethod extends Component
{
    protected object $clientAction;
    protected string $endpoint;

    public string $section;
    public string $icon   = 'header-map-marker';
    public array $methods = [];


    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'pickup-methods/';
    }

    private function getDataUserPickupMethod()
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

    public function loadContent()
    {
        $response      = $this->getDataUserPickupMethod()['data'];
        $this->methods = Arr::except($response, ['is_picked_up_in_store', 'pickup_icon']);
        $this->icon    = $response['pickup_icon'];
        
        if ($response['is_picked_up_in_store']) {
            $this->dispatch('picked-up-in-store');
        }
    }

    public function render()
    {
        return view('livewire.general.components.modal-pickup-method');
    }
}
