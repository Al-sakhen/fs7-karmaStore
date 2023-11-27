<?php

use App\Http\Controllers\Dashbaord\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('dashboard-panel')->middleware(['auth', 'checkAdmin'])->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
});






























// ================== Breeze package ==================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
