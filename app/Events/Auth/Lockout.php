<?php

namespace App\Events\Auth;

use App\Http\Requests\Auth\LoginRequest;

/** 
 * Locked out event when the user too many false attempt.
 */
class Lockout
{
    /**
     * Create a new instance of the data login request event.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest $request
     */
    public function __construct(
        public LoginRequest $request
    ) {}
}
