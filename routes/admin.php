<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('users', UserController::class)->except('show');
Route::resource('categories', CategoryController::class)->except('create', 'show');
