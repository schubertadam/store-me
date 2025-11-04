<?php

use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::resource('', LoginController::class, ['names' => 'login'])->only(['index', 'store']);

Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
    Route::get('', [RegisterController::class, 'create'])->name('create');
    Route::post('', [RegisterController::class, 'store'])->name('store');
    Route::get('success', [RegisterController::class, 'success'])->name('success');
});

Route::get('activate/{token}', ActivationController::class)->name('account.activate');

