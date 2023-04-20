<?php

use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\TenantController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::group(
        [
            'prefix' => 'tenant',
        ],
        function () {
            Route::get('index', [TenantController::class, 'index'])->name('tenant.index');
            Route::get('search/{value}', [TenantController::class, 'search'])->name('tenant.search');
            Route::get('menu/{tenant}', [MenuController::class, 'index'])->name('tenant.menu');
            Route::get('menu/{tenant}/{value?}', [MenuController::class, 'filterOrsort'])->name('tenant.filterOrSort');
            Route::get('menu/{tenant}/{filter?}/{sort?}', [MenuController::class, 'filterNsort'])->name('tenant.sortNfilter');
        }
    );

    Route::group(
        [
            'prefix' => 'menu',
        ],
        function () {
            //
        }
    );

    Route::get('tes-auth', [UserController::class, 'tes']);
});

Route::get('tes', [UserController::class, 'tes']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
