<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Models\Inventory;
use Illuminate\Routing\RouteGroup;
use Illuminate\Routing\Router;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    $title = 'Dashboard';
    return view('dashboard', compact('title'));
});

Route::prefix('master')->group(function () {
    Route::get('produk', [ProductController::class, 'index'])->name('master-product');
    Route::get('supplier', [SupplierController::class, 'index'])->name('master-supplier');
    Route::get('customer', [CustomerController::class, 'index'])->name('master-customer');
});

Route::get('inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase');

Route::prefix('auth')->group(function () {

    Route::get('login', function(){
        return view('auth.login');
    });

});
