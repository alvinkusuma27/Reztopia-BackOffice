<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('tenant.page.dashboard');
// })->name('dashboard');

Route::get('/menu', function () {
    return view('tenant.page.menu');
})->name('menu');

Route::get('/laporan', function () {
    return view('tenant.page.laporan');
})->name('laporan');

Route::get('/profile', function () {
    return view('tenant.page.profile');
})->name('profile');

// Route::get('/login', function () {
//     return view('tenant.auth.login');
// })->name('login');

Route::group(
    [
        'prefix' => 'auth'
        // 'middleware' => 'auth', 'CheckRole:admin'
    ],
    function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('post_login', [AuthController::class, 'post_login'])->name('post_login');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', [AuthController::class, 'post_register'])->name('post_register');
    }
);

Route::group(
    [
        'middleware' => 'auth', 'CheckRole:admin,kantin'
    ],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    }
);

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/forgot-password', function () {
    return view('tenant.auth.forgot-password');
})->name('forgot-password');

Route::get('/sent-forgot-password', function () {
    return view('tenant.auth.sent-forgot-password');
})->name('sent-forgot-password');

Route::get('/success-reset', function () {
    return view('tenant.auth.success-reset');
})->name('success-reset');
