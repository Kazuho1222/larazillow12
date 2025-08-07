<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [IndexController::class, 'index']
);
Route::get('/hello', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class);

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::get('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::get('login', [AuthController::class, 'destroy'])
    ->name('logout');
