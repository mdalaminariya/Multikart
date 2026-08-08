<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\OtpAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/send-otp', [OtpAuthController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpAuthController::class, 'verifyOtp']);
Route::post('/reset-password', [OtpAuthController::class, 'resetPassword']);
