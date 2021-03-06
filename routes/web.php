<?php

use Illuminate\Routing\RouteGroup;
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
    return redirect()->route('dashboard.index');
});

Route::group(['middleware' => ['auth']], function () {
    Route::view('/home', 'home')->name('home');
    Route::view('/profile', 'profile.user-profile-information-form')->name('user-profile-information.edit');
    Route::view('/user/change-password', 'auth.passwords.change-password')->name('password.edit');
});
