<?php

use Illuminate\Support\Facades\Route;

// =======================
// AUTH & USER
// =======================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;

// =======================
// ADMIN CONTROLLERS BARU
// =======================
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| USER ROOM LIST + DETAIL
|--------------------------------------------------------------------------
*/
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.list');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->whereNumber('id')->name('rooms.show');

/*
|--------------------------------------------------------------------------
| BOOKING USER (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');

/*
|--------------------------------------------------------------------------
| ADMIN (TERPROTEKSI role:admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['role:admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin (Pakai data Supabase)
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Kamar
        Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

        // Admin Kelola Pengguna
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');

        // Admin Booking
        Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
        Route::patch('/booking/{id}', [AdminBookingController::class, 'update'])->name('booking.update');
        Route::delete('/booking/{id}', [AdminBookingController::class, 'destroy'])->name('booking.destroy');
    });

/*
|--------------------------------------------------------------------------
| USER DASHBOARD (role:user)
|--------------------------------------------------------------------------
*/
Route::prefix('user')
    ->middleware(['role:user'])
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[AuthController::class, 'register']);

Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
