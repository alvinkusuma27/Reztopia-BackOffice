<?php

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

Route::get('/', function () {
    return view('tenant.page.dashboard');
})->name('dashboard');

Route::get('/menu', function () {
    return view('tenant.page.menu');
})->name('menu');

Route::get('/laporan', function () {
    return view('tenant.page.laporan');
})->name('laporan');

Route::get('/profile', function () {
    return view('tenant.page.profile');
})->name('profile');

Route::get('/login', function () {
    return view('tenant.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('tenant.auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('tenant.auth.forgot-password');
})->name('forgot-password');

Route::get('/sent-forgot-password', function () {
    return view('tenant.auth.sent-forgot-password');
})->name('sent-forgot-password');

Route::get('/success-reset', function () {
    return view('tenant.auth.success-reset');
})->name('success-reset');
