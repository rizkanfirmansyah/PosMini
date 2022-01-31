<?php

use App\Http\Controllers\ProductController;
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
});

Route::prefix('auth')->group(function () {

    Route::get('login', function(){
        return view('auth.login');
    });

});
