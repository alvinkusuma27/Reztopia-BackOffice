<?php

use App\Http\Controllers\LaporanController;

Route::group(
    [
        'middleware' => ['auth', 'role:admin,kantin']
    ],
    function () {
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('laporan/{id}', [LaporanController::class, 'index_admin'])->name('laporan_admin');
        Route::post('laporan/date', [LaporanController::class, 'filter_date'])->name('filter_date');
        Route::get('print_laporan/{date}/{id}', [LaporanController::class, 'print'])->name('print');
    }
);
