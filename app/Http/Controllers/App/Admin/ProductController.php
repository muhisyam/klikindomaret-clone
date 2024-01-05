<?php

namespace App\Http\Controllers\App\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\CreateMultipartAction;
use App\Actions\MergeArrayFieldErrorAction;
use App\Services\Backend\ApiCallService;
use App\Services\Backend\PaginationService;

class ProductController extends Controller
{
    protected const apiUrl = 'http://127.0.0.1:8080/api/v1/products';

    public function __construct(
        protected ApiCallService $apiService,
        protected PaginationService $paginateService,
        protected CreateMultipartAction $createMultipartAction, 
        protected MergeArrayFieldErrorAction $mergeErrorAction, 
    ) {}

    public function index(Request $request) 
    {
        $url = $search = static::apiUrl;
        
        $data = $this->apiService->getData($url, $request);
        $data['meta'] = $this->paginateService->changeLinksUrl($data['meta'], $search);
        $data['meta']['custom_links'] = $this->paginateService->customPaginationLinks($data['meta']);

        return view('admin.product.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.product.input');
    }
    
    public function store(Request $request)
    {
        $url = static::apiUrl;

        $param = $this->createMultipartAction->execute($request->all(), 'product_images');
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            $data['errors']['product_images'] = $this->mergeErrorAction->execute($data['errors'], 'product_images');
            
            return redirect()->route('products.create')->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('products.index')->with([
            'success' => [
                'title' => 'Berhasil Tambah Produk',
                'message' => $data['data']['product_name'],
            ],
        ]);
    }

    public function edit(string $slug)
    {
        $url = static::apiUrl . '/' . $slug;

        $data = $this->apiService->showData($url);

        if (isset($data['errors'])) {
            // TODO: redirect to 404 not found
            return;
            // return redirect()->route('products.create')->with(['inputError' => $data['error']])->withInput();
        }

        return view('admin.product.input', ['data' => $data['data']]);
    }

    public function update(Request $request, string $slug) 
    {
        $url = static::apiUrl . '/' . $slug;
        
        $param = $this->createMultipartAction->execute($request->all(), 'product_images');
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            // TODO: Add service for multiple image error
            return redirect()->route('products.edit', ['product' => $slug])->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('products.index')->with([
            'success' => [
                'title' => 'Berhasil Update Produk',
                'message' => $data['data']['product_name'],
            ]
        ]);
    }

    public function destroy(string $slug)
    {
        $url = static::apiUrl . '/' . $slug;
        
        $data = $this->apiService->deleteData($url);

        if (isset($data['errors'])) {
            // TODO: redirect to 404 not found
            return;
        }

        return redirect()->route('products.index')->with([
            'success' => [
                'title' => 'Berhasil Hapus Produk',
                'message' => $data['data']['product_name'],
            ]
        ]);
    }
}