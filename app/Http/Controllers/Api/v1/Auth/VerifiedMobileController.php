<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Traits\VerifyUserMobile;
use Illuminate\Http\Request;

class VerifiedMobileController extends Controller
{
    use VerifyUserMobile;

    public function store(Request $request)
    {
        $this->verifyMobile();

        return response()->json(['otp' => $this->otpCode]);
    }
}
