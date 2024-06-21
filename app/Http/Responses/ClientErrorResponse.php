<?php 

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;

class ClientErrorResponse
{
    public function toResponse($response): RedirectResponse
    {
        return match ($response['meta']['status_code']) {
            404 => redirect()->route('error.404'),
            403 => redirect()->route('error.403'),
            401 => redirect()->route('homepage', ['auth' => 'login']),
        };
    }
}