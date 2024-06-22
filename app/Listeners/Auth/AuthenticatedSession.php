<?php

namespace App\Listeners\Auth;

/**
 * Create new session for auth user.
 */
class AuthenticatedSession
{
    public function handle(object $event): void
    {
        $dataResponse = $event->response['data'];

        session([
            'auth' => [
                'user'  => $dataResponse['user'],
                'token' => $dataResponse['token'],
            ]
        ]);

        session()->regenerate();
    }
}
