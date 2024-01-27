<?php

namespace App\Http\Controllers\App\Admin;

use App\Actions\CreateMultipartAction;
use App\Actions\ErrorResponseAction;
use App\Http\Controllers\Controller;
use App\Services\Backend\ApiCallService;
use App\Services\Backend\PaginationService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected const pageRole = 'admin';
    protected const apiUrl = 'http://127.0.0.1:8080/api/v1/categories';

    public function __construct(
        protected ApiCallService $apiService,
        protected CreateMultipartAction $createMultipartAction,
        protected ErrorResponseAction $errorResponseAction,
        protected PaginationService $paginateService,
    ) {}

    public function index(Request $request) 
    {
        $url = $search = static::apiUrl;

        $data = $this->apiService->getData($url, $request);
        $data['meta'] = $this->paginateService->changeLinksUrl($data['meta'], $search);
        $data['meta']['custom_links'] = $this->paginateService->customPaginationLinks($data['meta']);

        return view('admin.category.index-parent', ['data' => $data]);
    }

    public function subIndex(Request $request, string $slug) 
    {
        $url = $search = static::apiUrl . '/sub/' . $slug;

        $data = $this->apiService->getData($url, $request);
        $data['meta'] = $this->paginateService->changeLinksUrl($data['meta'], $search);
        $data['meta']['custom_links'] = $this->paginateService->customPaginationLinks($data['meta']);

        return view('admin.category.index-subcategory', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.category.input-parent');
    }

    public function store(Request $request)
    {   
        $url = static::apiUrl;
        
        $param = $this->createMultipartAction->execute($request->all(), 'category_image');
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('categories.create')->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title' => 'Berhasil Tambah Kategori',
                'message' => $data['data']['category_name'],
            ],
        ]);
    }

    public function edit(string $slug)
    {
        $url = static::apiUrl . '/' . $slug;

        $data = $this->apiService->showData($url);

        if (isset($data['errors'])) {
            return $this->errorResponseAction->execute(static::pageRole, $data['errors']);
        }

        return view('admin.category.input-parent', ['data' => $data['data']]);
    }

    public function update(Request $request, string $slug) 
    {
        $url = static::apiUrl . '/' . $slug;

        $param = $this->createMultipartAction->execute($request->all(), 'category_image');
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('categories.edit', ['category' => $slug])->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title' => 'Berhasil Update Kategori',
                'message' => $data['data']['category_name'],
            ]
        ]);
    }

    public function destroy(string $slug)
    {
        $url = static::apiUrl . '/' . $slug;
        
        $data = $this->apiService->deleteData($url);

        if (isset($data['errors'])) {
            return $this->errorResponseAction->execute(static::pageRole, $data['errors']);
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title' => 'Berhasil Hapus Kategori',
                'message' => $data['data']['category_name'],
            ]
        ]);
    }
}
