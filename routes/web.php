<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 1️⃣ Halaman daftar kamar
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

        // 2️⃣ Form tambah kamar (harus di atas route dinamis)
        Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

        // 3️⃣ Edit & update
        Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

        // 4️⃣ Hapus kamar
        Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });
