<?php

namespace App\Livewire\General\Checkout;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutSummary extends Component
{
    protected object $clientAction;
    protected string $endpoint;
    
    public int $deliveryPrice = 0;
    public int $discountTotal = 0;
    public int $grandTotal    = 0;
    public int $normalTotal   = 0;
    public bool $loading      = false;

    public function __construct(
    ) {
        $this->clientAction = app(ClientRequestAction::class);
        $this->endpoint     = config('api.url') . 'checkouts';
    }

    #[On('content-loaded')]
    public function initSummary(array $summary)
    {
        $this->normalTotal   = $summary['total_product_discount'] + $summary['grand_total'];
        $this->deliveryPrice = $summary['total_delivery_price'];
        $this->discountTotal = $summary['total_product_discount'];
        $this->grandTotal    = $summary['grand_total'] + $this->deliveryPrice;
    }

    public function updateCart($quantityChanged)
    {
        $this->dispatch('qty-content-changed', quantityChanged: $quantityChanged);
        $this->reset('discountTotal', 'grandTotal', 'normalTotal');
    }

    public function getPaymentToken()
    {
        $this->loading = true;
        $response      = $this->getPaymentSnapToken();

        // TODO: Validate response token
        $this->dispatch('success-get-token', token: $response);
    }

    private function getPaymentSnapToken()
    {
        $userToken = session('auth_token');

        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                headers: [
                    'Authorization' => 'Bearer ' . $userToken
                ],
            )
        );
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-summary');
    }
}
