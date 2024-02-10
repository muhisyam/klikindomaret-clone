<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthenticateResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisteredController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'fullname' => ucwords($request->fullname),
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'mobile_number' => $request->mobile_number,
        ]);

        $user->forceFill(['mobile_number_verified_at' => now()])->save();
        $user->token = $user->createToken('auth-token')->plainTextToken;
                
        return new AuthenticateResource($user);
    }
}
