<?php

namespace App\Http\Controllers\Frontend\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\PaginationService;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;

class CategoryController extends Controller
{
    const apiUrl = 'http://127.0.0.1:8080/api/v1/categories';

    public function index(PaginationService $paginateService, Request $request) {
        $client = new Client();
        $url = $search = static::apiUrl;

        if ($request->input('page')) {
            $url .= '?page=' . $request->input('page');
        }

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        $data['meta'] = $paginateService->changeLinksUrl($data['meta'], $search);
        $data['meta']['custom_links'] = $paginateService->customPaginationLinks($data['meta']);

        return view('admin.category.index-parent', ['data' => $data]);
    }

    public function subIndex(PaginationService $paginateService, Request $request, string $slug) {
        $client = new Client();
        $url = $search = static::apiUrl . '/sub/' . $slug;

        if ($request->input('page')) {
            $url .= '?page=' . $request->input('page');
        }

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        $data['meta'] = $paginateService->changeLinksUrl($data['meta'], $search);

        return view('admin.category.index-subcategory', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.category.input-parent');
    }

    
    protected $variable;

    public function store(Request $request)
    {
        // $param = [
        //     'parent_id' => $request->parent_id,
        //     'name' => $request->name,
        //     'slug' => $request->slug,
        //     'status' => $request->status,
        //     'image' => $request->image,
        // ];

        $param = $request->all();


        $client = new Client();
        $url = static::apiUrl;
        
        try {
            $response = $client->request('POST', $url, [
                'header' => ['Content-Type', 'application/json'],
                'form_params' => $param,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return redirect()->route('categories.index')->with([
                'success' => [
                    'title' => 'Berhasil Tambah Kategori',
                    'message' => $data['data']['name'],
                ]
            ]);

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);
            
            return redirect()->route('categories.create')->with([ 'inputError' => $error ])->withInput();
        }
    }
}
