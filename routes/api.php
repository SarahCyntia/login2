<?php

use App\Http\Controllers\Auth\VerifikasiController;
use App\Http\Controllers\LoginOtpController;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/send-email', [OtpController::class, 'sendOtp'])->name('otp'); 

Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);

Route::post('/send-otp', [LoginOtpController::class, 'sendOTP']);
Route::post('/verify', [VerifikasiController::class, 'verify']);