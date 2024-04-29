<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
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
        $username          = session('user')['username'];
        $sessionTokenKey   = $username . '-payment-token';
        $sessionPaymentKey = $username . '-payment-created';

        session()->forget([$sessionTokenKey, $sessionPaymentKey]);

        return view('general.checkout.index');
    }

    public function paymented(Request $request)
    {

    }
}
