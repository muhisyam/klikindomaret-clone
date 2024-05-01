<?php

namespace App\Http\Controllers\Web\General;

use App\Actions\ClientRequestAction;
use App\Actions\CreateMultipartAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    protected string $endpoint;

    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CreateMultipartAction $multipartAction,
    ) {
        $this->endpoint = config('api.url') . 'carts';
    }
    
    public function homepage(): View
    {
        return view('general.home.index');
    }

    public function detailProduct(string $productSlug): View
    {
        return view('general.detail-product.index', ['section' => $productSlug]);
    }

    public function checkout(): View
    {
        $this->forgetPaymentSession();

        return view('general.checkout.index');
    }

    public function paymented(array $request)
    {
        $formData = $this->multipartAction->create($request);

        $this->forgetPaymentSession();
        $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . 'complete',
                formData: $formData,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
            )
        );
    }

    private function forgetPaymentSession()
    {
        $username          = session('user')['username'];
        $sessionTokenKey   = $username . '-payment-token';
        $sessionPaymentKey = $username . '-payment-created';

        session()->forget([$sessionTokenKey, $sessionPaymentKey]);
    }
}
