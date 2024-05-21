<?php

namespace App\Livewire\Admin\Order;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Component;

class Table extends Component
{
    /**
     * Api client request handler
     *
     * @var object
     */
    protected object $clientAction;

    /**
     * Api endpoint
     *
     * @var string
     */
    protected string $endpoint;
    
    /**
     * Order data instance.
     * 
     * @var null|array $orders
    */
    public null|array $orders = null;

    /**
     * Table head filter data
     *
     * @var string
     */
    public string $sortBy, $orderBy;
 
    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint = config('api.url') . 'orders/admin/';
    }

    public function loadContent()
    {
        $this->orders = $this->getDataRetailerOrders()['data'];
    }

    private function getDataRetailerOrders()
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

    public function render()
    {
        return view('livewire.admin.order.table');
    }
}
