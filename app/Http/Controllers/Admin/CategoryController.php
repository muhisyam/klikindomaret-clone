<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateMultipartAction;
use App\Actions\GetSpesificFieldAction;
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

    public function store(CreateMultipartAction $action, Request $request)
    {   
        $client = new Client();
        $url = static::apiUrl;
        $param = $action->handle($request->all());
        
        try {
            $response = $client->request('POST', $url, [
                'header' => ['Content-Type', 'application/json'],
                'multipart' => $param,
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

    // TODO: error update function cant update
    public function update(CreateMultipartAction $action, Request $request, string $id) 
    {
        $client = new Client();
        $url = static::apiUrl . '/' . $id;
        $param = $action->handle($request->all());
        
        try {
            $response = $client->request('POST', $url, [
                'header' => ['Content-Type', 'application/json'],
                'multipart' => $param,
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

    public function destroy(GetSpesificFieldAction $action, string $id)
    {
        $client = new Client();
        $url = static::apiUrl . '/' . $id;
        
        try {
            $categoryName = $action->handle(static::apiUrl, $id, 'name');
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
}
