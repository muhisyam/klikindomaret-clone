<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthenticateResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisteredController extends Controller
{
    /**
     * Handle an incoming registration request then, save data user.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest $request
     * @return \App\Http\Resources\Auth\AuthenticateResource
     */
    public function store(RegisterRequest $request): AuthenticateResource
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
