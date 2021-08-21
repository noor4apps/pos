<?php

use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('admin')->name('dashboard.')->middleware('auth')->group(function () {

            Route::get('/', [DashboardController::class, 'index'])->name('index');

            // user route
            Route::resource('users', UserController::class)->except(['show']);

            // category route
            Route::resource('categories', CategoryController::class)->except(['show']);

            // product route
            Route::resource('products', ProductController::class)->except(['show']);

            // client route
            Route::resource('clients', ClientController::class)->except(['show']);
            Route::resource('clients.orders', ClientOrderController::class)->except(['show']);

            // order route
            Route::resource('orders', OrderController::class)->except(['show']);
            Route::get('/orders/{order}/products', [OrderController::class, 'products'])->name('orders.products');
            Route::put('/orders/{order}/update_status', [OrderController::class, 'update_status'])->name('orders.update_status');

        });// end of dashboard routes

    });// end of localization
