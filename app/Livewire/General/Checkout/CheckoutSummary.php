<?php

namespace App\Livewire\General\Checkout;

use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutSummary extends Component
{
    public int $discountTotal;
    public int $grandTotal;
    public int $normalTotal;

    #[On('content-loaded')]
    public function initSummary(array $summary)
    {
        $this->discountTotal = $summary['eachProductDiscount'];
        $this->grandTotal    = $summary['grandTotal'];
        $this->normalTotal   = $this->discountTotal + $this->grandTotal;
    }


    public function render()
    {
        return view('livewire.general.checkout.checkout-summary');
    }
}
