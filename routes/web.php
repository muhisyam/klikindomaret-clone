<?php

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
Route::get('test/backend', [UserController::class, 'index']);

Route::get('/categories', function () {
    return view('admin.category.index-category');
});

Route::get('/categories/makanan', function () {
    return view('admin.category.index-subcategory');
})->name('subcategories');

Route::get('/categories/create', function () {
    return view('admin.category.input-parent');
});

Route::get('/categories/create/sub', function () {
    return view('admin.category.input-subcategory');
});

Route::get('/products', function () {
    return view('admin.product.index');
});

Route::get('/products/create', function () {
    return view('admin.product.input');
});

Route::get('/orders', function () {
    return view('admin.order.index');
});

Route::get('/users', function () {
    return view('admin.users.index');
});

// Route::get('/', [FrontendController::class, 'index'])->name('frontendHome');