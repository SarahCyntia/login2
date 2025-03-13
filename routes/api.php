<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * route "/register"
 * @method name()"POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method name() "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method  name()"GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
 });

/**
 * route "/logout"
 * @method name() "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');