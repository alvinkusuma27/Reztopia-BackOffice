<?php

use App\Http\Controllers\DashboardController;

Route::group(
    [
        'middleware' => ['auth', 'role:admin']
    ],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    }
)
