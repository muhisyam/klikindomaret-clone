<?php

namespace App\Listeners;

class AuthenticatedSession
{
    /**
     * Handle the authenticated event.
     * Create new session for auth user.
     */
    public function handle(object $event): void
    {
        session([
            'auth_token' => $event->response['data']['token'],
            'user' => $event->response['data']['user'],
        ]);

        session()->regenerate();
    }
}
