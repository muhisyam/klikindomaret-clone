<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\StoreController;
use App\Http\Controllers\Api\v1\RegionController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\SupplierController;
use App\Http\Controllers\Api\v1\ProductImageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// group categories
Route::group(['prefix' => 'categories'], function() {
    Route::apiResource('/', CategoryController::class);
    Route::get('/sub/{category}', [CategoryController::class, 'subIndex'])->name('category.subIndex');
    Route::get('/top-children/{category}', [CategoryController::class, 'getTopLevelWithChildren'])->name('category.topChildren');
});
Route::apiResource('regions', RegionController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('stores', StoreController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('product-images', ProductImageController::class);