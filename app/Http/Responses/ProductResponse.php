<?php 

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;

class ProductResponse implements Responsable
{
    public function __construct(
        public string $title,
        public array $response,
    ) {}

    public function toResponse($request): RedirectResponse
    {
        if ($this->isClientResponseStatusError()) {
            return app(ClientErrorResponse::class)->toResponse($this->response);
        }

        return redirect()->route('products.index')->with([
            'success' => [
                'title'   => $this->title,
                'message' => $this->response['data']['content_name'],
            ],
        ]);
    }

    private function isClientResponseStatusError(): bool
    {
        return $this->response['meta']['status_code'] >= 400;
    }
}