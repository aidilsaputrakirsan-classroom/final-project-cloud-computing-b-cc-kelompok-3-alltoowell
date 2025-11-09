<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

// 1. HALAMAN UTAMA (HOME)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. BOOKING ROOM1, ROOM2, DLL
Route::get('/booking/{roomCode}', [BookingController::class, 'show'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.show');

Route::post('/booking/{roomCode}', [BookingController::class, 'store'])
    ->where('roomCode', 'room[0-9]+')
    ->name('booking.store');

// 3. ADMIN
Route::get('/admin', [BookingController::class, 'index'])->name('admin');
Route::patch('/admin/{id}', [BookingController::class, 'update']);
Route::delete('/admin/{id}', [BookingController::class, 'destroy']);
