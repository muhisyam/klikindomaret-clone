<?php

use App\Http\Controllers\Api\v1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductImageController;
use App\Http\Controllers\Api\v1\RegionController;
use App\Http\Controllers\Api\v1\StoreController;
use App\Http\Controllers\Api\v1\SupplierController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\DebuggingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
    
Route::middleware('guest')->group(function() {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

// group categories
Route::apiResource('categories', CategoryController::class);
Route::group(['prefix' => 'categories'], function() {
    Route::get('/sub/{category}', [CategoryController::class, 'subIndex'])->name('category.subIndex');
    Route::get('/top-children/{category}', [CategoryController::class, 'getTopLevelWithChildren'])->name('category.topChildren');
});
Route::apiResource('regions', RegionController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('stores', StoreController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('product-images', ProductImageController::class);