<?php

use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::resource('', LoginController::class, ['names' => 'login'])->only(['index', 'store']);

Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
    Route::resource('', RegisterController::class)->only(['index', 'store']);
    Route::get('success', [RegisterController::class, 'success'])->name('success');
});

Route::get('activate/{token}', ActivationController::class)->name('account.activate');

