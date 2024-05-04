<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request, CheckoutService $checkoutService)
    {
        $snapToken  = $checkoutService->getSnapToken($request);

        return response()->json(['snap_token' => $snapToken], 201);
    }

    public function paymented(Request $request)
    {
        
    }
}
