<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\PickupMethodService;
use Illuminate\Http\Request;

class PickupMethodController extends Controller
{
    public function __construct(
        protected PickupMethodService $pickupService,
    ) {}

    public function show(Request $request)
    {
        $detailAddress = $this->getUserPickupData($request);

        return response()->json(['data' => $detailAddress], 200);
    }
    
    public function getUserPickupData(Request $request)
    {
        $userPickupMethods = $request->user()->pickupMethod;
        $detailAddress     = $this->pickupService->getPickupDetailAddress($userPickupMethods)->toArray();

        return $detailAddress;
    }
}
