<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $client = new Client();
        $url = 'http://127.0.0.1:8080/api/v1/categories';
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        return view('admin.product.index', ['data' => $data['data']]);
    }
}
