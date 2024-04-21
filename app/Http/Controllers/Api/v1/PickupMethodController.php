<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\PickupMethodService;
use Illuminate\Http\Request;

class PickupMethodController extends Controller
{
    public function show(Request $request, PickupMethodService $pickupService, string $username)
    {
        $userPickupMethods = $request->user()->pickupMethod;
        $detailAddress     = $pickupService->getPickupDetailAddress($userPickupMethods);

        return response()->json(['data' => $detailAddress], 200);
    }
}
