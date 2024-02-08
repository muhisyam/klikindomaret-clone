<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyMobileRequest;
use App\Traits\VerifyUserMobile;

class VerifiedMobileController extends Controller
{
    use VerifyUserMobile;

    public function store(VerifyMobileRequest $request)
    {
        $this->verifyMobile($request);

        return response()->json(['otp' => $this->otpCode]);
    }
}
