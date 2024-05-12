<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\FrontEnd\Cart\CartController;
use App\Http\Controllers\FrontEnd\Categories\CategoriesController;
use App\Http\Controllers\FrontEnd\Customer\CustomerController;
use App\Http\Controllers\FrontEnd\Home\HomeController;
use App\Http\Controllers\FrontEnd\Orders\OrderController;
use App\Http\Controllers\FrontEnd\Product\ProductController;
use App\Http\Service\Media\UploadMediaService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::name('fe.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::any('/product/{cmd?}', [ProductController::class, 'index'])->name('product');
    Route::any('cate/{cmd?}.html', [CategoriesController::class, 'check_list'])->name('category');
    Route::middleware('auth:web')->group(function (){
        Route::any('/customer/{cmd?}', [CustomerController::class, 'index'])->name('customer');
        Route::any('/upload', [UploadMediaService::class, 'upload'])->name('upload');
        Route::any('/cart/{cmd?}', [CartController::class, 'index'])->name('cart');
        Route::any('/orders/{cmd?}', [OrderController::class, 'index'])->name('orders');
    });
});

Route::prefix('social')->name('social.')->group(function () {
    Route::get('auth/{provider}', [SocialLoginController::class, 'loginUsingSocial'])->name('login');
    Route::get('callback/{provider}', [SocialLoginController::class, 'callbackFromSocial'])->name('callback');
});

