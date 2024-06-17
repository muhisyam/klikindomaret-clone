<?php

namespace App\Http\Controllers\Web\Admin;

use App\Actions\ClientRequestAction;
use App\DataTransferObjects\ClientRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Responses\ProductResponse;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
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
        protected ProductService $productService,
    ) {
        $this->endpoint = config('api.url') . 'products/';
    }

    /**
     * Direct to admin product parent list page.
    */
    public function index(): View
    {
        return view('admin.product.index.index', [ 
            'title' => 'List Produk'
        ]);
    }

    /**
     * Retieve product list either in admin or user interface.
    */
    public function getListProducts(string $extendedUrl = '', array $header = []): array
    {
        $response = $this->getDataProducts($extendedUrl, $header);
        $response = $this->productService->updatingMetaLink($response, $this->endpoint);
        $response = $this->productService->setFilterKey($response);

        return $response;
    }

    /**
     * Retieve data products with sub url or params.
    */
    public function getDataProducts(string $extendedUrl, array $header): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method:   'GET',
                endpoint: $this->endpoint . $extendedUrl,
                headers:  $header,
            )
        );
    }

    /**
     * Direct to admin product input page.
    */
    public function create(): View
    {
        return view('admin.product.input.input', [ 
            'title' => 'Tambah Produk',
        ]);
    }

    /**
     * Send request for store data product.
     * 
     * @param \App\Http\Requests\ProductRequest $request
    */
    public function store(ProductRequest $request): ProductResponse
    {
        $response = $this->postDataRequest($request->validated());

        return new ProductResponse('Tambah Produk', $response);
    }

    /**
     * Post request form data products.
     * 
     * @param \App\Http\Requests\ProductRequest|array $request
    */
    public function postDataRequest(ProductRequest|array $request): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method:   'POST',
                endpoint: $this->endpoint,
                headers:  [
                    'Authorization' => getAuthToken()
                ],
                formData:  $request,
                formImage: 'product_images',
            )
        );
    }

    /**
     * Direct to admin product edit page with data $productSlug.
    */
    public function edit(string $productSlug): View
    {
        return view('admin.product.input.input', [
            'title'       => 'Ubah Produk',
            'productSlug' => $productSlug,
        ]);
    }

    /**
     * Send request for update data product.
     * 
     * @param \App\Http\Requests\ProductRequest $request
     * @param string $productSlug
    */
    public function update(ProductRequest $request, string $productSlug): ProductResponse
    {
        $formData  = $request->validated();
        $formData += ['_method' => 'put'];

        $response = $this->clientAction->request(
            new ClientRequestDto(
                method:   'POST',
                endpoint: $this->endpoint . $productSlug,
                headers:  [
                    'Authorization' => getAuthToken()
                ],
                formData:  $formData,
                formImage: 'product_images',
            )
        );

        return new ProductResponse('Ubah Produk', $response);
    }

    /**
     * Send request for delete data product.
     * 
     * @param string $productSlug
    */
    public function destroy(string $productSlug): ProductResponse
    {
        $response = $this->deleteDataRequest($productSlug);

        return new ProductResponse('Hapus Kategori', $response);
    }

    /**
     * Delete request form data products.
     * 
     * @param string $productSlug
    */
    public function deleteDataRequest(string $productSlug): array
    {
        return $this->clientAction->request(
            new ClientRequestDto(
                method:   'DELETE',
                endpoint: $this->endpoint . $productSlug,
                headers:  [
                    'Authorization' => getAuthToken()
                ],
            )
        );
    }
}