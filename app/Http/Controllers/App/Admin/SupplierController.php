<?php

namespace App\Http\Controllers\App\Admin;

use Illuminate\Http\Request;
use App\Actions\ErrorResponseAction;
use App\Http\Controllers\Controller;
use App\Actions\CreateMultipartAction;
use App\Services\Backend\ApiCallService;
use App\Services\Backend\PaginationService;

class SupplierController extends Controller
{
    protected const pageRole = 'admin';
    protected const apiUrl = 'http://127.0.0.1:8080/api/v1/suppliers';

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

        return view('admin.supplier.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.supplier.input');
    }
    
    public function store(Request $request)
    {
        $url = static::apiUrl;

        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('suppliers.create')->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('suppliers.index')->with([
            'success' => [
                'title' => 'Berhasil Tambah Wilayah',
                'message' => $data['data']['supplier_name'],
            ],
        ]);
    }
    // $supplierCode -> flagCode . flagName
    public function edit(string $supplierCode)
    {
        $url = static::apiUrl . '/' . $supplierCode;

        $data = $this->apiService->showData($url);

        if (isset($data['errors'])) {
            return $this->errorResponseAction->execute(static::pageRole, $data['errors']);
        }

        return view('admin.supplier.input', ['data' => $data['data']]);
    }

    public function update(Request $request, string $supplierCode) 
    {
        $url = static::apiUrl . '/' . $supplierCode;
        
        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('suppliers.edit', ['supplier' => $supplierCode])->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('suppliers.index')->with([
            'success' => [
                'title' => 'Berhasil Update Wilayah',
                'message' => $data['data']['supplier_name'],
            ]
        ]);
    }

    public function destroy(string $supplierCode)
    {
        $url = static::apiUrl . '/' . $supplierCode;
        
        $data = $this->apiService->deleteData($url);

        if (isset($data['errors'])) {
            return $this->errorResponseAction->execute(static::pageRole, $data['errors']);
        }

        return redirect()->route('regions.index')->with([
            'success' => [
                'title' => 'Berhasil Hapus Wilayah',
                'message' => $data['data']['region_name'],
            ]
        ]);
    }
}