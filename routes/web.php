<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard kamar
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Data penyewa
Route::get('/admin/penyewa', [AdminController::class, 'penyewa'])->name('admin.penyewa');

// Ubah status penyewa
Route::post('/admin/penyewa/update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
