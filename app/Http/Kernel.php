Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    });
