<?php

use App\Http\Controllers\MenuController;

Route::group(
    [
        'middleware' => ['auth', 'role:kantin']
    ],
    function () {
        Route::get('menu', [MenuController::class, 'index'])->name('menu');
        Route::post('menu/category', [MenuController::class, 'store'])->name('menu.store');
        Route::post('menu/product/delete', [MenuController::class, 'destroy_product'])->name('menu.destroy.product');
        Route::post('menu/product/store', [MenuController::class, 'store_product'])->name('menu.store.product');
        Route::post('menu/category/delete', [MenuController::class, 'destroy'])->name('menu.destroy');
        Route::post('menu/category/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::post('menu/product/{id}', [MenuController::class, 'update_product'])->name('menu.update.product');
    }
);
