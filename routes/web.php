<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    if (session('user_role') === 'admin') {
        return redirect('/admin/dashboard');
    }
    if (session('user_role') === 'user') {
        return redirect('/user/dashboard');
    }
    return "Halaman Website Umum (Belum Login)";
});

// Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard User
Route::middleware(['role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return "Selamat datang di Dashboard User";
    });
});

// Dashboard Admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Selamat datang di Dashboard Admin";
    });
});
