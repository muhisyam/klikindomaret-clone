<?php

namespace App\Livewire\Admin\Order;

use Livewire\Attributes\On;
use Livewire\Component;

class DetailSectionHeader extends Component
{
    /**
     * Order data instance.
     * 
     * @var null|array $orders
     */
    public null|array $order = null;

    #[On('content-loaded')]
    public function loadContent($order)
    {
        $this->order = $order['order'];
    }

    public function render()
    {
        return view('livewire.admin.order.detail-section-header');
    }
}
