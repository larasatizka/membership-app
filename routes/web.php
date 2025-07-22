<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Google OAuth
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Facebook OAuth
Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::put('/membership/update', [AuthController::class, 'updateMembership'])->name('membership.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



