<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductsController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth', 'index');
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::get('/auth/logout', 'logout');
});

Route::middleware('IsLogin')->group(function () {
    Route::controller(KasirController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/bayar', 'payment');
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::put('/products/edit/{id}', 'edit');
        Route::get('/products/delete/{id}', 'delete');
    });
});
