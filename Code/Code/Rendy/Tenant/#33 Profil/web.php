<?php

use App\Http\Controllers\ProfileController;

Route::group(
    [
        'middleware' => ['auth', 'role:admin,kantin']
    ],
    function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');
        Route::post('profile/update_image_profile', [ProfileController::class, 'update_image_profile'])->name('update_image_profile');
        Route::post('profile/change_password', [ProfileController::class, 'change_password'])->name('change_password');
    }
);
