<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route: Halaman Utama (Beranda KOST-SI)
Route::get('/', [HomeController::class, 'index']);

// Route: Fallback ke welcome (opsional, kalau mau)
Route::get('/welcome', function () {
    return view('welcome');
});
