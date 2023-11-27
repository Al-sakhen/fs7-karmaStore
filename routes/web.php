<?php

use App\Http\Controllers\Dashbaord\DashboardController;
use App\Http\Controllers\Dashbaord\ProductsController;
use App\Http\Controllers\ProfileController;
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
    return view('frontend.index');
})->name('home');

Route::get('/shop' , function(){
    return view('frontend.shop');
})->name('shop');






require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
