<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
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
    Route::put('/auth/settings/{$id}', 'settings')->middleware('IsLogin');
});

Route::middleware('IsLogin')->group(function () {
    Route::controller(KasirController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/bayar', 'payment');
    });

    Route::controller(ReportsController::class)->group(function () {
        Route::get('/reports', 'index');
        Route::get('/print', 'print');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/users', 'index');
        Route::put('/users/{id}', 'edit');
        Route::post('/users/{id}/store', 'update');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index');
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/products', 'index');
        Route::post('/products/store', 'store');
        Route::get('/products/create', 'create');
        Route::put('/products/edit/{id}', 'edit');
        Route::get('/products/delete/{id}', 'delete');
    });
});
