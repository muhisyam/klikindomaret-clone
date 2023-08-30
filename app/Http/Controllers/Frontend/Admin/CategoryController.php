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
        $data['meta'] = $this->changeLinksUrl($data['meta']);

        return view('admin.category.index-category', ['data' => $data]);
    }

    public function subIndex(string $slug) {
        $client = new Client();
        $url = static::apiUrl . '/sub/' . $slug;
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);

        return view('admin.category.index-subcategory', ['data' => $data]);
    }

    public function changeLinksUrl(array $data) {
        $curentUrl = url()->current();

        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['url'] = str_replace(static::apiUrl, $curentUrl, $value['url']);
        } 

        return $data;
    }
}
