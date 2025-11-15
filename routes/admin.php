<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SummernoteController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('users', UserController::class)->except('show');
Route::resource('categories', CategoryController::class)->except('create', 'show');
Route::resource('products', ProductController::class)->except('show');

Route::post('/summernote/upload', [SummernoteController::class, 'upload'])->name('summernote.upload');
