<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const apiUrl = 'http://127.0.0.1:8080/api/v1/categories';

    public function index(Request $request) {
        $client = new Client();
        $url = static::apiUrl;

        if ($request->input('page')) {
            $url .= '?page=' . $request->input('page');
        }

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        $data['meta'] = $this->changeLinksUrl($data['meta'], $url);

        return view('admin.category.index-parent', ['data' => $data]);
    }

    public function subIndex(Request $request, string $slug) {
        $client = new Client();
        $url = $search = static::apiUrl . '/sub/' . $slug;

        if ($request->input('page')) {
            $url .= '?page=' . $request->input('page');
        }

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        $data['meta'] = $this->changeLinksUrl($data['meta'], $search);

        return view('admin.category.index-subcategory', ['data' => $data]);
    }

    public function changeLinksUrl(array $data, string $search) {
        $curentUrl = url()->current();
        
        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['url'] = str_replace($search, $curentUrl, $value['url']);
        } 

        return $data;
    }
}
