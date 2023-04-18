<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
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

// Route::get('/menu', function () {
//     return view('tenant.page.menu');
// })->name('menu');

// Route::get('/laporan', function () {
//     return view('tenant.page.laporan');
// })->name('laporan');

// Route::get('/profile', function () {
//     return view('tenant.page.profile');
// })->name('profile');

Route::redirect('/', 'dashboard');

Route::group(
    [
        'prefix' => 'auth'
        // 'middleware' => 'auth', 'CheckRole:admin'
    ],
    function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('post_login', [AuthController::class, 'post_login'])->name('post_login');
        // Route::get('register', [AuthController::class, 'register'])->name('register');
        // Route::post('register', [AuthController::class, 'post_register'])->name('post_register');
        Route::get('forgot-password', [UserController::class, 'forgot'])->name('forgot-password');
        Route::post('forgot-password', [UserController::class, 'forgot_store'])->name('forgot-password.store');
        Route::get('sent-forgot-password', [UserController::class, 'sent_forgot_password'])->name('sent-forgot-password');
        Route::get('success-reset', [UserController::class, 'success_reset'])->name('success-reset');
        Route::get('reset-password/{token}', [UserController::class, 'reset_password'])->name('reset-password');
    }
);

Route::group(
    [
        'middleware' => 'auth', 'CheckRole:admin,kantin'
    ],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('tenant', [TenantController::class, 'index'])->name('tenant');
        Route::post('tenant', [TenantController::class, 'store'])->name('tenant.store');
        Route::post('tenant/{id}', [TenantController::class, 'update'])->name('tenant.update');
        Route::get('tenant/{id}', [TenantController::class, 'destroy'])->name('tenant.destroy');
        // Route::get('menu', [MenuController::class, 'index'])->name('menu');
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');
        Route::post('profile/update_image_profile', [ProfileController::class, 'update_image_profile'])->name('update_image_profile');
        Route::post('profile/change_password', [ProfileController::class, 'change_password'])->name('change_password');
    }
);

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/forgot-password', function () {
//     return view('tenant.auth.forgot-password');
// })->name('forgot-password');

// Route::get('/sent-forgot-password', function () {
//     return view('tenant.auth.sent-forgot-password');
// })->name('sent-forgot-password');

// Route::get('/success-reset', function () {
//     return view('tenant.auth.success-reset');
// })->name('success-reset');
