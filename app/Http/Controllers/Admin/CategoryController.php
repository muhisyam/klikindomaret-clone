<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
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

    public function store(Request $request)
    {
        $request = $request->all();

        // pindah ke action / service / job
        foreach ($request as $key => $value) {
            if (!(Str::contains($key, 'token') || Str::contains($key, 'image'))) {
                $param[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $param[] = [
            'name'  => 'image',
            'contents' => fopen($request['image']->path(), 'r'),
            'filename' => $request['image']->getClientOriginalName(), 
        ];
        
        $client = new Client();
        $url = static::apiUrl;
        
        try {
            $response = $client->request('POST', $url, [
                'header' => ['Content-Type', 'application/json'],
                'multipart' => $param,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            dd($data);
            return redirect()->route('categories.index')->with([
                'success' => [
                    'title' => 'Berhasil Tambah Kategori',
                    'message' => $data['data']['name'],
                ]
            ]);

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);

            dd($response);
            
            return redirect()->route('categories.create')->with([ 'inputError' => $error ])->withInput();
        }
    }

    public function edit(string $id)
    {
        $client = new Client();
        $url = static::apiUrl . '/' . $id;

        try {
            $response = $client->request('GET', $url);
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return view('admin.category.input-parent', ['data' => $data['data']]);

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);

            // TODO: redirect to 404 not found
        }
    }

    public function update(Request $request, string $id) 
    {
        $param = $request->all();
        
        $client = new Client();
        $url = static::apiUrl . '/' . $id;
        
        try {
            $response = $client->request('PUT', $url, [
                'header' => ['Content-Type', 'application/json'],
                'form_params' => $param,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            return redirect()->route('categories.index')->with([
                'success' => [
                    'title' => 'Berhasil Update Kategori',
                    'message' => $data['data']['name'],
                ]
            ]);

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);
            
            return redirect()->route('categories.edit', ['category' => $id])->with([ 'inputError' => $error ])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $client = new Client();
        $url = static::apiUrl . '/' . $id;
        
        try {
            $categoryName = $this->getSpesificData($id, 'name');
            $response = $client->request('delete', $url);
            
            return redirect()->route('categories.index')->with([
                'success' => [
                    'title' => 'Berhasil Hapus Kategori',
                    'message' => $categoryName,
                ]
            ]);

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);
            
            // TODO: redirect to 404 not found
        }
    }

    public function getSpesificData(string $id, string $key) 
    {
        $client = new Client();
        $url = static::apiUrl . '/' . $id;

        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['data'][$key];
    }
}