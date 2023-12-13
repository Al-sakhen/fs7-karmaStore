<?php

use App\Http\Controllers\Front\FrontController;
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
});





require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
