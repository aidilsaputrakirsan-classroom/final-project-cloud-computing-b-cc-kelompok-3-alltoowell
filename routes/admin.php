<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| ADMIN ONLY ROUTES (DASHBOARD)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('role:admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    });
