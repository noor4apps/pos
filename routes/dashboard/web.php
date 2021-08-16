<?php

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
        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

            Route::get('/index', [DashboardController::class, 'index'])->name('index');

            // user route
            Route::resource('users', UserController::class)->except(['show']);

            // category route
            Route::resource('categories', CategoryController::class)->except(['show']);

            // product route
            Route::resource('products', ProductController::class)->except(['show']);

            // client route
            Route::resource('clients', ClientController::class)->except(['show']);

        });// end of dashboard routes

    });// end of localization
