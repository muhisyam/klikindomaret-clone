<?php 

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class CategoryResponse implements Responsable
{
    public function __construct(
        protected array $response,
        protected bool $redirect = true,
    ) {}

    public function toResponse($request)
    {
        if (! $this->redirect) {
            return $this->response;
        }

        if ($this->isClientResponseStatusError()) {
            return new ClientErrorResponse($this->response);
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title'   => 'Berhasil Tambah Kategori',
                'message' => $this->response['data']['content_name'],
            ],
        ]);
    }

    private function isClientResponseStatusError()
    {
        return $this->response['meta']['status_code'] >= 400;
    }
}