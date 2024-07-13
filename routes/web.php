<?php

use App\Http\Controllers\App\Auth\LoginController;
use App\Http\Controllers\App\Auth\RegisterController;
use App\Http\Controllers\App\Auth\VerifyMobileController;
use App\Http\Controllers\DebuggingController;
use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\FeaturedSectionController;
use App\Http\Controllers\Web\Admin\OrderController;
use App\Http\Controllers\Web\Admin\ProductController;
use App\Http\Controllers\Web\Admin\PromotionBannerController;
use App\Http\Controllers\Web\General\GeneralController;
use App\Http\Controllers\Web\General\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Debug
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test', [DebuggingController::class, 'test']);
Route::get('execute', [DebuggingController::class, 'execute']);
Route::get('refresh', [DebuggingController::class, 'refresh']);
Route::get('refresh2', [DebuggingController::class, 'apiRefresh2']);
Route::get('page/{promo}', [DebuggingController::class, 'pagePromoTest'])->name('page.promo');
Route::get('page/{store}', [DebuggingController::class, 'pagePromoTest'])->name('page.store');
Route::get('check-auth', [DebuggingController::class, 'checkAuth']);

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

// Authentication
Route::post('login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('verify-mobile', [VerifyMobileController::class, '__invoke'])->name('verify.mobile'); //TODO: Ganti ke method mobile
Route::post('verify-otp', [VerifyMobileController::class, 'store'])->name('verify.otp'); //TODO: Ganti ke method otp
Route::post('register', [RegisterController::class, 'register'])->name('register.complete');

// Admin Interface
Route::prefix('admin')->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::get('categories/sub/{category}', [CategoryController::class, 'indexChildren'])->name('categories.sub-index');
    Route::resource('products', ProductController::class);
    Route::prefix('content')->group(function() {
        Route::resource('featureds', FeaturedSectionController::class);
        Route::resource('promotions', PromotionBannerController::class);
    });
    Route::prefix('orders')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('{user}/order/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});

// General Interface
Route::get('/', [GeneralController::class, 'homepage'])->name('homepage');
Route::get('search', [SearchController::class, 'index'])->name('home.search');
Route::get('products/{product}', [GeneralController::class, 'detailProduct'])->name('home.detail-product');

Route::middleware('auth.web')->group(function() {
    Route::get('checkouts', [GeneralController::class, 'checkout'])->name('checkout');
    Route::get('info/order/status', [GeneralController::class, 'order'])->name('info.order');
});

Route::get('/users', function () {
    return view('admin.users.index');
});

Route::get('/userss', function () {
    return view('frontend.category.index');
})->name('coba');

Route::prefix('errors')->name('error.')->group(function() {
    Route::get('/not-found', fn() => view('livewire.pages.error-404'))->name('404');
    Route::get('/fobidden', fn() => view('livewire.pages.error-403'))->name('403');
});