<?php

use App\Http\Controllers\App\Admin\CategoryController;
use App\Http\Controllers\App\Admin\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('frontend.home.index');
});

Route::resource('categories', CategoryController::class);
Route::get('categories/sub/{category}', [CategoryController::class, 'subIndex'])->name('categories.subIndex');
Route::resource('products', ProductController::class);

Route::get('/orders', function () {
    return view('admin.order.index');
});

Route::get('/users', function () {
    return view('admin.users.index');
});

Route::get('/error/notfound', function () {
    return view('livewire.pages.error-404', );
})->name('error.404');