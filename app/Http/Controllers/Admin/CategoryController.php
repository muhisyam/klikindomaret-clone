<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateMultipartAction;
use App\Http\Controllers\Controller;
use App\Services\Backend\CategoryService;
use App\Services\Backend\PaginationService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected const apiUrl = 'http://127.0.0.1:8080/api/v1/categories';

    public function __construct(
        protected CategoryService $categoryService,
        protected PaginationService $paginateService,
        protected CreateMultipartAction $createMultipartAction, 
    ) {}

    public function index(Request $request) 
    {
        $url = $search = static::apiUrl;

        $data = $this->categoryService->getData($url, $request);
        $data['meta'] = $this->paginateService->changeLinksUrl($data['meta'], $search);
        $data['meta']['custom_links'] = $this->paginateService->customPaginationLinks($data['meta']);

        return view('admin.category.index-parent', ['data' => $data]);
    }

    public function subIndex(Request $request, string $slug) 
    {
        $url = $search = static::apiUrl . '/sub/' . $slug;

        $data = $this->categoryService->getData($url, $request);
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

        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->categoryService->postData($url, $param);

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

    public function edit(string $id)
    {
        $url = static::apiUrl . '/' . $id;

        $data = $this->categoryService->showData($url);

        if (isset($data['errors'])) {
            // TODO: redirect to 404 not found
            return;
            // return redirect()->route('categories.create')->with(['inputError' => $data['error']])->withInput();
        }

        return view('admin.category.input-parent', ['data' => $data['data']]);
    }

    public function update(Request $request, string $id) 
    {
        $url = static::apiUrl . '/' . $id;

        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->categoryService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('categories.edit', ['category' => $id])->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title' => 'Berhasil Update Kategori',
                'message' => $data['data']['category_name'],
            ]
        ]);
    }

    public function destroy(string $id)
    {
        $url = static::apiUrl . '/' . $id;
        
        $data = $this->categoryService->deleteData($url);

        if (isset($data['errors'])) {
            // TODO: redirect to 404 not found
            return;
        }

        return redirect()->route('categories.index')->with([
            'success' => [
                'title' => 'Berhasil Hapus Kategori',
                'message' => $data['data']['category_name'],
            ]
        ]);
    }
}
