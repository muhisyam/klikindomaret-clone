<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Http\Requests\VerifyMobileRequest;
use App\Traits\VerifyUserMobile;

class VerifiedMobileController extends Controller
{
    use VerifyUserMobile;

    public function verifyMobile(VerifyMobileRequest $request)
    {
        $this->verify($request);

        return response()->json([
            'data' => [
                'otp' => $this->otpCode,
                'step' => 'verify_otp',
            ],
            'meta' => [
                'status_code' => 200,
                'message' => 'Success',
            ],
        ], 200);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $this->verified($request);

        return response()->json([
            'data' => [
                'step' => 'complete_register'
            ],
            'meta' => [
                'status_code' => 202,
                'message' => 'Accepted',
            ],
        ], 202);
    }
}
