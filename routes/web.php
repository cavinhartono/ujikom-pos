<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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
    Route::get('/auth/settings', 'settings')->middleware('IsLogin');
    Route::put('/auth/update', 'updateSettings')->middleware('IsLogin');
});

Route::middleware('IsLogin')->group(function () {
    Route::controller(KasirController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/transaction/store', 'store');
        Route::get('/struck/{id}', 'print_struck');
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::controller(ProductsController::class)->group(function () {
        Route::get('/products', 'index');
        Route::post('/products/store', 'store');
        Route::get('/products/create', 'create');
        Route::post('/products/search', 'search');
        Route::put('/products/edit/{id}', 'edit');
        Route::get('/products/delete/{id}', 'delete');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users/store', 'store');
        Route::put('/users/{id}', 'edit');
        Route::post('/users/{id}/update', 'update');
        Route::delete('/users/delete', 'delete');
        Route::post('/users/search', 'search');
    });

    Route::resource('carts', CartController::class);
    Route::post('carts/scan', [CartController::class, 'scan']);

    Route::controller(ReportsController::class)->group(function () {
        Route::get('/reports', 'index');
        Route::get('/print', 'print');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions', 'index');
    });
});
