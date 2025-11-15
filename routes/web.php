<?php

use Illuminate\Support\Facades\Route;

// AUTH & USER CONTROLLERS
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\RoomController as AdminRoomController;

// USER ROOM CONTROLLER
use App\Http\Controllers\RoomController as UserRoomController;


/* ============================================================
|                           HOME
============================================================ */
Route::get('/', [HomeController::class, 'index'])->name('home');


/* ============================================================
|                  USER – LIST & DETAIL ROOMS
|     (untuk user dan publik melihat daftar & detail kamar)
============================================================ */

// daftar kamar
Route::get('/rooms', [UserRoomController::class, 'index'])
    ->name('rooms.list');

// detail kamar — FIX: Hapus whereNumber karena ID Supabase == UUID
Route::get('/rooms/{id}', [UserRoomController::class, 'show'])
    ->name('rooms.show');


/* ============================================================
|                       BOOKING (PUBLIC)
============================================================ */
Route::get('/booking/{roomCode}', [BookingController::class, 'show'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.show');

Route::post('/booking/{roomCode}', [BookingController::class, 'store'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.store');


/* ============================================================
|                      ADMIN ROUTES
|              (Hanya admin yang boleh akses)
============================================================ */
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['role:admin'])
    ->group(function () {

        // Dashboard Admin
        Route::get('/', [BookingController::class, 'index'])
            ->name('dashboard');

        // CRUD kamar
        Route::get('/rooms',           [AdminRoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create',    [AdminRoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms',          [AdminRoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}',      [AdminRoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{id}',   [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

        // Update status booking admin
        Route::patch('/{id}',  [BookingController::class, 'update'])->name('booking.update');
        Route::delete('/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    });


/* ============================================================
|                         USER DASHBOARD
============================================================ */
Route::prefix('user')
    ->name('user.')
    ->middleware(['role:user'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
    });


/* ============================================================
|                           AUTH
============================================================ */
Route::get('login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login',   [AuthController::class, 'login']);

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register',[AuthController::class, 'register']);

Route::post('logout',  [AuthController::class, 'logout'])->name('logout');
