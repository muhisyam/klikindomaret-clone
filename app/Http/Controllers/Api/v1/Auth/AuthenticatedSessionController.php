<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Traits\AuthenticatesUser;

class AuthenticatedSessionController extends Controller
{
    use AuthenticatesUser;

    /**
     * Handle an incoming authentication request then, 
     * create user token that has been authenticated.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \App\Http\Resources\LoginResource
     */
    public function store(LoginRequest $request)
    {
        $this->authenticated($request);

        $user = $request->user();
        $user->tokens()->delete();
        $user->token = $user->createToken('auth-token')->plainTextToken;

        return new LoginResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
