<?php

namespace App\Events;

use App\Http\Requests\Auth\LoginRequest;

class Lockout
{/**
     * The throttled request.
     *
     * @var \App\Http\Requests\Auth\LoginRequest
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest $request
     * @return void
     */
    public function __construct(LoginRequest $request)
    {
        $this->request = $request;
    }
}
