<?php 

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ClientErrorResponse implements Responsable
{
    public function __construct(
        protected array $response,
    ) {}

    public function toResponse($request)
    {
        return match ($this->response['status_code']) {
            404 => redirect()->route('not-found'),
        };
    }
}