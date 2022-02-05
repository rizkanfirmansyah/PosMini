<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
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
        Route::get('get/all', [ProductController::class, 'showAll'])->name('product-show-all');
        Route::post('store', [ProductController::class, 'store'])->name('product-store');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('product-update');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product-destroy');
    });
    Route::prefix('suppliers')->group(function () {
        Route::get('get', [SupplierController::class, 'show'])->name('supplier-show');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier-store');
        Route::post('update/{id}', [SupplierController::class, 'update'])->name('supplier-update');
        Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('supplier-edit');
        Route::delete('destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier-destroy');
    });
    Route::prefix('customers')->group(function () {
        Route::get('get', [CustomerController::class, 'show'])->name('customer-show');
        Route::post('store', [CustomerController::class, 'store'])->name('customer-store');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer-update');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer-edit');
        Route::delete('destroy/{id}', [CustomerController::class, 'destroy'])->name('customer-destroy');
    });
    Route::prefix('purchases')->group(function () {
        Route::get('get', [PurchaseController::class, 'show'])->name('purchase-show');
        Route::post('store', [PurchaseController::class, 'store'])->name('purchase-store');
        Route::post('update/{id}', [PurchaseController::class, 'update'])->name('purchase-update');
        Route::get('edit/{id}', [PurchaseController::class, 'edit'])->name('purchase-edit');
        Route::delete('destroy/{id}', [PurchaseController::class, 'destroy'])->name('purchase-destroy');
    });
});
