<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// SEMUA ROOM: /booking/room1, room2, room999
Route::get('/booking/{roomCode}', [BookingController::class, 'show'])
    ->where('roomCode', 'room[0-9]+');

Route::post('/booking/{roomCode}', [BookingController::class, 'store'])
    ->where('roomCode', 'room[0-9]+');

// ADMIN
Route::get('/admin', [BookingController::class, 'index']);
Route::patch('/admin/{id}', [BookingController::class, 'update']);
Route::delete('/admin/{id}', [BookingController::class, 'destroy']);

Route::get('/', fn() => redirect('/booking/room1'));
