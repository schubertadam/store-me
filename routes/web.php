<?php

use App\Http\Controllers\Guest\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class)->only(['index', 'show'])->names('products');
