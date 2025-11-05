<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::middleware('auth')->group(function () {
    Route::get('/booking/{room}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{room}', [BookingController::class, 'store'])->name('booking.store');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings');
        Route::patch('/admin/bookings/{id}', [BookingController::class, 'update'])->name('admin.bookings.update');
    });
});

Route::get('/', function () {
    return view('welcome');
});
