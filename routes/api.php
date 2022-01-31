<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });
    Route::prefix('products')->group(function () {
        Route::get('get', [ProductController::class, 'show'])->name('product-show');
        Route::post('store', [ProductController::class, 'store'])->name('product-store');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('product-update');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product-destroy');
    });
});
