<?php

use App\Http\Controllers\AktivitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
    Route::get('/daftar', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/daftar', [RegisterController::class, 'store'])->name('register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/dashboard')->group(function () {
        Route::resource('/users', UserController::class);
        Route::post('/users/reset-password', [UserController::class, 'reset'])->name('users.reset');

        Route::resource('/aktivitas', AktivitasController::class);
        Route::resource('/kriteria', KriteriaController::class);
        Route::resource('/alternatif', AlternatifController::class);
        Route::resource('/pasien', PasienController::class);
        Route::resource('/nilai-alternatif', NilaiAlternatifController::class);
    });

    // logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
