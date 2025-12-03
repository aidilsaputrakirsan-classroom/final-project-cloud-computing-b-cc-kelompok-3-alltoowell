<?php

use Illuminate\Support\Facades\Route;

// USER Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

// ADMIN Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\ActivityLogController;

/*
|--------------------------------------------------------------------------
| HOME (bebas akses)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| USER (cek login langsung di controller)
|--------------------------------------------------------------------------
*/
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');

Route::get('/my-bookings', [BookingController::class, 'userBookings'])->name('user.bookings');


/*
|--------------------------------------------------------------------------
| ADMIN (role admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [AdminRoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');

        Route::get('/booking', [BookingManagementController::class, 'index'])->name('booking.index');
        Route::patch('/booking/{id}', [BookingManagementController::class, 'updateStatus'])->name('booking.update');

        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');

        // ⭐ ACTIVITY LOG (BARU)
        Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity.index');
        Route::get('/activity-log/{id}', [ActivityLogController::class, 'show'])->name('activity.show');
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


/*
|--------------------------------------------------------------------------
| BLOCK STORAGE PUBLIC ACCESS
|--------------------------------------------------------------------------
*/
Route::get('/storage/{path}', function () {
    return abort(404);
})->where('path', '.*');
