<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\Payments\PaypalController;
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

Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/product/{id}', 'showProduct')->name('product.show');
});


ROute::middleware(['auth', 'verified'])->group(function () {

    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add/{id}', 'addToCartSession')->name('addToSession');
    });

    Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });


    Route::controller(PaypalController::class)->prefix('paypal')->name('paypal.')->group(function () {
        Route::get('/create/{orderId}', 'create')->name('create');
        Route::get('/rollback/{orderId}', 'rollback')->name('rollback');
        Route::get('/cancel/{orderId}', 'cancel')->name('cancel');
    });
});


require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
