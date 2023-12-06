<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\App\Admin\ProductController;
use App\Http\Controllers\Frontend\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.order.index');
});

Route::resource('categories', CategoryController::class);
Route::get('categories/sub/{category}', [CategoryController::class, 'subIndex'])->name('categories.subIndex');
Route::resource('products', ProductController::class);

// TODO: Delete this
Route::get('/categories/create/sub', function () {
    return view('admin.category.input-subcategory');
});

Route::get('/orders', function () {
    return view('admin.order.index');
});

Route::get('/users', function () {
    return view('admin.users.index');
});