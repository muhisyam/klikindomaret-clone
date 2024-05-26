<?php

namespace App\Livewire\Admin\Order;

use App\Http\Controllers\Web\Admin\OrderController;
use Livewire\Component;

class Table extends Component
{
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

    public function loadContent()
    {
        $this->orders = app(OrderController::class)->getDataRetailerOrders()['data'];

        $this->dispatch('content-loaded');
    }

    public function render()
    {
        return view('livewire.admin.order.table');
    }
}
