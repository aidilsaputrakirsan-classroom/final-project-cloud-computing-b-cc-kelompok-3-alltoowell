<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// ================== Route Home ==================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ================== Route Booking ==================
Route::get('/booking/{roomCode}', [BookingController::class, 'show'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.show');

Route::post('/booking/{roomCode}', [BookingController::class, 'store'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.store');

// ================== Route Admin ==================
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Halaman daftar kamar
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

        // Form tambah kamar
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

        // Edit & update kamar
        Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

        // Hapus kamar
        Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

        // Halaman admin untuk booking (tambahan dari HEAD)
        Route::get('/', [BookingController::class, 'index'])->name('dashboard');
        Route::patch('/{id}', [BookingController::class, 'update']);
        Route::delete('/{id}', [BookingController::class, 'destroy']);
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
