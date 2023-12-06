<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('dashboard-panel')->middleware(['auth', 'checkAdmin'])->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/products', [ProductsController::class, 'index'])->name('products');

    // resource controller
    /**
     *  7 methods
     *  in 1 line 
     */
    Route::resource('categories', CategoryController::class); // 7 routes

    Route::resource('brands', BrandController::class);
});






























// ================== Breeze package ==================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
