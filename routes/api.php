<?php

use App\Http\Controllers\Api\v1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\v1\Auth\RegisteredController;
use App\Http\Controllers\Api\v1\Auth\VerifiedMobileController;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CheckoutController;
use App\Http\Controllers\Api\v1\FeaturedSectionController;
use App\Http\Controllers\Api\v1\MinimalBrandController;
use App\Http\Controllers\Api\v1\MinimalCategoryController;
use App\Http\Controllers\Api\v1\MinimalRetailerController;
use App\Http\Controllers\Api\v1\MinimalSupplierController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\PickupMethodController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\PromotionBannerController;
use App\Http\Controllers\Api\v1\RegionController;
use App\Http\Controllers\Api\v1\RetailerController;
use App\Http\Controllers\Api\v1\SearchController;
use App\Http\Controllers\Api\v1\SupplierController;
use App\Http\Controllers\DebuggingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Debug
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('refresh', [DebuggingController::class, 'apiRefresh'])->name('apiDebug');
Route::get('refresh2', [DebuggingController::class, 'apiRefresh2'])->name('apiDebug2');
Route::get('check-auth', [DebuggingController::class, 'apiCheckAuth'])->middleware('auth:sanctum');


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
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('verify-mobile', [VerifiedMobileController::class, 'verifyMobile']);
    Route::post('verify-otp', [VerifiedMobileController::class, 'verifyOtp']);
    Route::post('register', [RegisteredController::class, 'store']);
});

Route::apiResource('categories', CategoryController::class);
Route::get('categories/sub/{category}', [CategoryController::class, 'indexChildren'])->name('categories.children');

Route::apiResource('regions', RegionController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('retailers', RetailerController::class);
Route::apiResource('featured-sections', FeaturedSectionController::class);
Route::apiResource('promotion-banners', PromotionBannerController::class);
Route::get('promotion-min', [PromotionBannerController::class, 'indexMinified']);

Route::apiResource('products', ProductController::class);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('pickup-methods', PickupMethodController::class);
    Route::apiResource('carts', CartController::class);
    Route::post('checkouts', CheckoutController::class)->name('checkout');
    Route::post('checkouts/complete', [CheckoutController::class, 'paymented'])->name('checkout.complete');

    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        /* User Order Endpoints. Endpoint => orders/{users} */
        Route::get('{user}', 'indexUserOrder');
        Route::get('{user}/modal', 'showUserModalOrder');
        Route::put('{user}/pending', 'updateOnPending');
        Route::put('{user}/process', 'updateOnProcess');
        Route::delete('{user}', 'destroy');
        
        Route::prefix('admin')->group(function () {
            /* Retailer Order Endpoints. Endpoint => orders/admin/{users} */
            Route::get('{user}', 'indexRetailerOrder');
            Route::get('{user}/order/{order}', 'showRetailerDetailOrder');
            Route::put('{user}/order/{order}', 'retailerUpdateStatus');
        });
    });
});

Route::get('search/navbar', [SearchController::class, 'navbar']);
Route::get('search/products', [SearchController::class, 'product']);

Route::get('categories/resource/minimal', MinimalCategoryController::class);
Route::get('brands/resource/minimal', MinimalBrandController::class);
Route::get('suppliers/resource/minimal', MinimalSupplierController::class);
Route::get('retailers/resource/minimal', MinimalRetailerController::class);
