<?php

namespace App\Listeners\Auth;

/**
 * Create new session for auth user.
 */
class AuthenticatedSession
{
    public function handle(object $event): void
    {
        session([
            'auth_token' => $event->response['data']['token'],
            'user' => $event->response['data']['user'],
        ]);

        session()->regenerate();
    }
}
