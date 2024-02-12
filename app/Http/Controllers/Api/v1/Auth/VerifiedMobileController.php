<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyMobileRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Traits\VerifyUserMobile;
use Illuminate\Http\JsonResponse;

class VerifiedMobileController extends Controller
{
    use VerifyUserMobile;

    /**
     * Handle an incoming mobile request then, send otp code.
     *
     * @param  \App\Http\Requests\Auth\VerifyMobileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyMobile(VerifyMobileRequest $request): JsonResponse
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

    /**
     * Handle an otp request.
     *
     * @param  \App\Http\Requests\Auth\VerifyOtpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
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
