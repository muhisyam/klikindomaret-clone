<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturedContentController extends Controller
{
    public function index(Request $request) 
    {
        return view('admin.featured-content.index');
    }
}
