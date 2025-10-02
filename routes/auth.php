<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::resource('', LoginController::class, ['names' => 'login'])->only(['index', 'store']);
Route::resource('register', RegisterController::class, ['names' => 'register'])->only(['index', 'store']);
