<?php

namespace App\Livewire\Admin\Order;

use App\Http\Controllers\Web\Admin\OrderController;
use Livewire\Component;

class DetailSectionBody extends Component
{
    /**
     * Order Key from route path.
     * 
     * @var string $orderKey
     */
    public string $orderKey;
    
    /**
     * Order data instance.
     * 
     * @var null|array $orders
     */
    public null|array $order = null;

    public function loadContent()
    {
        $this->order = app(OrderController::class)->getDataRetailerDetailOrder($this->orderKey)['data'];

        $this->dispatch('content-loaded', order: [
            'order'     => $this->order,
            'order_key' => $this->orderKey,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.order.detail-section-body');
    }
}
