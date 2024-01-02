<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products', [TestController::class, 'index']);
ROute::middleware('auth:api')->group(function () {
    Route::get('products/{id}', [TestController::class, 'show']);
    Route::get('parent-categories', [CategoryController::class, 'getParentCategories']);
    Route::post('categories/create', [CategoryController::class, 'store']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
