<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthenticateResource;
use App\Traits\Auth\AuthenticatesUser;

class AuthenticatedSessionController extends Controller
{
    use AuthenticatesUser;

    /**
     * Handle an incoming authentication request then, 
     * create user token that has been authenticated.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest $request
     * @return \App\Http\Resources\AuthenticateResource
     */
    public function store(LoginRequest $request): AuthenticateResource
    {
        $this->authenticated($request);

        $user = $request->user();
        $user->tokens()->delete();
        $user->token = $user->createToken('auth-token')->plainTextToken;

        return new AuthenticateResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
