<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\HomeController;

// ================== Route Home ==================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ================== Route Admin ==================
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 1️⃣ Halaman daftar kamar
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

        // 2️⃣ Form tambah kamar
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

        // 3️⃣ Edit & update
        Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

        // 4️⃣ Hapus kamar
        Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });

// ================== Auth Routes ==================

// Menampilkan halaman login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// Proses login
Route::post('login', [AuthController::class, 'login']);
// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Menampilkan halaman register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
// Proses register
Route::post('register', [AuthController::class, 'register']);
