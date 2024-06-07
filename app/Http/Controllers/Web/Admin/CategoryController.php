<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Responses\CategoryResponse;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * Api endpoint
     *
     * @var string
     */
    protected string $endpoint;

    /**
     * Create a new resource instance.
     *
     * @return void
    */
    public function __construct(
        protected ClientRequestAction $clientAction,
        protected CategoryService $categoryService,
    ) {
        $this->endpoint = config('api.url') . 'categories/';
    }

    /**
     * Direct to admin category parent list page.
    */
    public function index(): View 
    {
        return view('admin.category.index.index-parent');
    }

    /**
     * Direct to admin category children list page.
    */
    public function indexChildren(): View 
    {
        return view('admin.category.index.index-children');
    }

    /**
     * Retieve category list either in admin or user interface.
    */
    public function getListCategories(null|string $extendedUrl = null, array $header = []): array
    {
        $response = $this->getDataCategories($extendedUrl, $header);
        $response = $this->categoryService->updatingMetaLink($response, $this->endpoint);
        $response = $this->categoryService->setFilterKey($response);

        return $response;
    }

    /**
     * Retieve data categories with sub url or params.
    */
    public function getDataCategories(null|string $extendedUrl, array $header): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'GET',
                endpoint: $this->endpoint . ($extendedUrl ?? ''),
                headers: $header,
            )
        );
    }

    /**
     * Direct to admin category input page.
    */
    public function create(): View
    {
        return view('admin.category.input.input');
    }

    /**
     * Send request for store data category.
     * 
     * @param \App\Http\Requests\CategoryRequest $request
    */
    public function store(CategoryRequest $request): CategoryResponse
    {
        $response = $this->postDataRequest($request);

        return new CategoryResponse('Tambah Kategori', $response);
    }

    /**
     * Post request form data categories.
     * 
     * @param \App\Http\Requests\CategoryRequest|array $request
    */
    public function postDataRequest(CategoryRequest|array $request): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
                formData: $request,
            )
        );
    }

    /**
     * Direct to admin category edit page with data $categorySlug.
    */
    public function edit(string $categorySlug): View
    {
        return view('admin.category.input.input', [
            'categorySlug' => $categorySlug
        ]);
    }

    /**
     * Send request for update data category.
     * 
     * @param \App\Http\Requests\CategoryRequest $request
     * @param string $categorySlug
    */
    public function update(CategoryRequest $request, string $categorySlug): CategoryResponse
    {
        $formData  = $request->validated();
        $formData += ['_method' => 'put'];
        $response  = $this->clientAction->request(
            new ClientRequestDto(
                method: 'POST',
                endpoint: $this->endpoint . $categorySlug,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
                formData: $formData,
            )
        );

        return new CategoryResponse('Ubah Kategori', $response);
    }

    /**
     * Send request for delete data category.
     * 
     * @param string $categorySlug
    */
    public function destroy(string $categorySlug): CategoryResponse
    {
        $response = $this->clientAction->request(
            new ClientRequestDto(
                method: 'DELETE',
                endpoint: $this->endpoint . $categorySlug,
                headers: [
                    'Authorization' => 'Bearer ' . session('auth_token')
                ],
            )
        );

        return new CategoryResponse('Hapus Kategori', $response);
    }
}
