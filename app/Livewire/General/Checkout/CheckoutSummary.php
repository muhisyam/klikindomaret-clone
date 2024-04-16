<?php

namespace App\Livewire\General\Checkout;

use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutSummary extends Component
{
    public int $discountTotal = 0;
    public int $grandTotal    = 0;
    public int $normalTotal   = 0;

    #[On('content-loaded')]
    public function initSummary(array $summary)
    {
        $this->discountTotal = $summary['eachProductDiscount'];
        $this->grandTotal    = $summary['grandTotal'];
        $this->normalTotal   = $this->discountTotal + $this->grandTotal;
    }

    public function updateCart($quantityChanged)
    {
        $this->dispatch('qty-content-changed', quantityChanged: $quantityChanged);
        $this->reset('discountTotal', 'grandTotal', 'normalTotal');
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-summary');
    }
}
