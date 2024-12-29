<?php

use App\Http\Controllers\site\LikeController;
use App\Http\Controllers\site\RateController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->as('auth.')->group(function () {
    Route::get('register', [\App\Http\Controllers\site\auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [\App\Http\Controllers\site\auth\RegisteredUserController::class, 'store'])->name('register');
    Route::get('login', [\App\Http\Controllers\site\auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login_user',[\App\Http\Controllers\site\auth\AuthenticatedSessionController::class,'authenticateUserName'])->name('authenticateUserName');
    Route::post('login', [\App\Http\Controllers\site\auth\AuthenticatedSessionController::class, 'store'])->name('store');
    Route::get('active', [\App\Http\Controllers\site\auth\ActiveController::class, 'active'])->name('active');
    Route::post('active', [\App\Http\Controllers\site\auth\ActiveController::class, 'confirm'])->name('confirm');
    Route::post('resend_code', [\App\Http\Controllers\site\auth\ActiveController::class, 'resend_code'])->name('resend_code');
    Route::get('forgot-password',[\App\Http\Controllers\site\auth\ForgetPasswordController::class,'change_pass'])->name('forget');
    Route::post('forgot-password',[\App\Http\Controllers\site\auth\ForgetPasswordController::class,'send_form'])->name('send_form');
    Route::get('recovery-password',[\App\Http\Controllers\site\auth\ForgetPasswordController::class,'recovery_pass'])->name('recovery-password');
    Route::post('recovery-password',[\App\Http\Controllers\site\auth\ForgetPasswordController::class,'store'])->name('store');
    Route::get('otp/{username}',[\App\Http\Controllers\site\auth\otpController::class,'otp_create'])->name('otp_create');
    Route::post('otp/{username}',[\App\Http\Controllers\site\auth\otpController::class,'otp_resend'])->name('otp_resend');
    Route::post('otp', [\App\Http\Controllers\site\auth\otpController::class,'otp_check_confirm'])->name('otp_check_confirm');
});

Route::middleware('auth')->as('user.')->group(function () {
    Route::get('change_profile',[\App\Http\Controllers\site\user\panelController::class,'change_profile'])->name('change_profile');
    Route::post('change_profile',[\App\Http\Controllers\site\user\panelController::class,'change_profile_store'])->name('change_profile_store');
    Route::get('panel',[\App\Http\Controllers\site\user\panelController::class,'index'])->name('panel');
    Route::get('comment',[\App\Http\Controllers\site\user\panelController::class,'comment'])->name('comment');
    Route::post('change_pass',[\App\Http\Controllers\site\user\panelController::class,'change_pass'])->name('change_pass');
    Route::get('like',[\App\Http\Controllers\site\user\panelController::class,'like'])->name('like');
    Route::post('like/{type}/{type_id?}',[LikeController::class,'store'])->name('like.store')->middleware(['access_like','auth']);
    Route::post('rate/{type}/{type_id}',[RateController::class,'store'])->name('rate.store');   //->middleware('access_rate')
    Route::get('logout',[\App\Http\Controllers\site\user\panelController::class,'logout'])->name('logout');
});


























