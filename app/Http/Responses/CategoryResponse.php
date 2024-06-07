<?php 

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class CategoryResponse implements Responsable
{
    public function __construct(
        public string $title,
        public array $response,
    ) {}

    public function toResponse($request)
    {
        if ($this->isClientResponseStatusError()) {
            return new ClientErrorResponse($this->response);
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title'   => $this->title,
                'message' => $this->response['data']['content_name'],
            ],
        ]);
    }

    private function isClientResponseStatusError()
    {
        return $this->response['meta']['status_code'] >= 400;
    }
}