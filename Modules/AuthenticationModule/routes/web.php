<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Modules\AuthenticationModule\App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth.module')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
