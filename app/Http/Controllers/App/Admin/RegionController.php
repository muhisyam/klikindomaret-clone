<?php

namespace App\Http\Controllers\App\Admin;

use Illuminate\Http\Request;
use App\Actions\ErrorResponseAction;
use App\Http\Controllers\Controller;
use App\Actions\CreateMultipartAction;
use App\Services\Backend\ApiCallService;
use App\Services\Backend\PaginationService;

class RegionController extends Controller
{
    protected const pageRole = 'admin';
    protected const apiUrl = 'http://127.0.0.1:8080/api/v1/regions';

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

        return view('admin.region.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.region.input');
    }
    
    public function store(Request $request)
    {
        $url = static::apiUrl;

        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('regions.create')->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('regions.index')->with([
            'success' => [
                'title' => 'Berhasil Tambah Wilayah',
                'message' => $data['data']['region_name'],
            ],
        ]);
    }

    public function edit(string $regionCode)
    {
        $url = static::apiUrl . '/' . $regionCode;

        $data = $this->apiService->showData($url);

        if (isset($data['errors'])) {
            return $this->errorResponseAction->execute(static::pageRole, $data['errors']);
        }

        return view('admin.region.input', ['data' => $data['data']]);
    }

    public function update(Request $request, string $regionCode) 
    {
        $url = static::apiUrl . '/' . $regionCode;
        
        $param = $this->createMultipartAction->execute($request->all());
        $data = $this->apiService->postData($url, $param);

        if (isset($data['errors'])) {
            return redirect()->route('regions.edit', ['region' => $regionCode])->with(['inputError' => $data])->withInput();
        }

        return redirect()->route('regions.index')->with([
            'success' => [
                'title' => 'Berhasil Update Wilayah',
                'message' => $data['data']['region_name'],
            ]
        ]);
    }

    public function destroy(string $regionCode)
    {
        $url = static::apiUrl . '/' . $regionCode;
        
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