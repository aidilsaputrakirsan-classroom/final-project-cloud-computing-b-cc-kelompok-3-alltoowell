<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\PenggunaController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| USER ROOMS
|--------------------------------------------------------------------------
*/
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.list');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

/*
|--------------------------------------------------------------------------
| USER BOOKING
|--------------------------------------------------------------------------
*/
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Rooms
        Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

        // BOOKING MANAGEMENT (ADMIN)
        Route::get('/booking', [BookingManagementController::class, 'index'])->name('booking.index');
        Route::patch('/booking/{id}', [BookingManagementController::class, 'updateStatus'])->name('booking.update');

        // Pengguna
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
