<?php

use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::resource('login', LoginController::class, ['names' => 'login'])->only(['index', 'store']);

Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
    Route::get('', [RegisterController::class, 'create'])->name('create');
    Route::post('', [RegisterController::class, 'store'])->name('store');
    Route::get('success', [RegisterController::class, 'success'])->name('success');
});

Route::get('activate/{token}', ActivationController::class)->name('account.activate');

Route::group(['prefix' => 'forgot-password', 'as' => 'forgot-password.'], function () {
    Route::get('', [ForgotPasswordController::class, 'create'])->name('create');
    Route::post('', [ForgotPasswordController::class, 'store'])->name('store');
    Route::get('success', [ForgotPasswordController::class, 'success'])->name('success');
});

Route::group(['prefix' => 'reset-password', 'as' => 'reset-password.'], function () {
    Route::get('{token}', [ResetPasswordController::class, 'edit'])->name('edit');
    Route::patch('{token}', [ResetPasswordController::class, 'update'])->name('update');
});

Route::group(['prefix' => '/invite/{token}', 'as' => 'invite.'], function () {
    Route::get('', [ResetPasswordController::class, 'edit'])->name('edit');
    Route::patch('', [ResetPasswordController::class, 'update'])->name('update');
});
