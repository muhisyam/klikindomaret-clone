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
    protected string $sessionPaymentKey;
    
    public int $deliveryPrice = 0;
    public int $discountTotal = 0;
    public int $grandTotal    = 0;
    public int $normalTotal   = 0;
    public bool $loading      = false;

    public function __construct(
    ) {
        $this->clientAction      = app(ClientRequestAction::class);
        $this->endpoint          = config('api.url') . 'checkouts';
        $this->sessionPaymentKey = session('user')['username'] . '-payment-created';
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
        $this->loading   = true;
        $sessionTokenKey = session('user')['username'] . '-payment-token';
        $isHasPendingPay = empty(session($this->sessionPaymentKey));
        $response        = ! $isHasPendingPay ? session($sessionTokenKey) : $this->getPaymentSnapToken();

        session([$sessionTokenKey => $response]);

        // TODO: complete this
        // if ($response['meta']['status'] != 201) {
        //     # code...
        // }

        $this->dispatch('success-get-token', token: $response);
    }

    private function getPaymentSnapToken()
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token'),
                ],
            )
        );
    }

    #[On('payment-pending')]
    public function paymentOnPending(string $orderId)
    {
        session([$this->sessionPaymentKey => $orderId]);
        
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.general.checkout.checkout-summary');
    }
}
