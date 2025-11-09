<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{uuid}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::post('/rooms/bulk', [RoomController::class, 'bulkAction'])->name('rooms.bulk');
    });
