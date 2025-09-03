<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::resource('', LoginController::class, ['names' => 'login'])->only(['index', 'store']);
