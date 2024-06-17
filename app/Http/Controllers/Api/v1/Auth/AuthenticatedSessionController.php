<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Enums\MetaStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthenticateResource;
use App\Traits\Auth\AuthenticatesUser;
use Illuminate\Http\Request;

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

        $user = $request
            ->user()
            ->load([
                'roleAs',
                'retailer.supplier',
                'pickupMethod',
            ]);

        $user->tokens()->delete();
        $user->token = $user->createToken('auth-token')->plainTextToken;

        return (new AuthenticateResource($user))->additional(MetaStatus::get('OK'));
    }

    /**
     * Remove current auth token user.
     * 
     * @param  \Illuminate\Http\Request $request
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
    }
}
