<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaginationService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
}
