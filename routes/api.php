<?php

use App\Http\Controllers\API\AlternatifController;
use App\Http\Controllers\API\ArasMobileController;
use App\Http\Controllers\API\AuthMobileController;
use App\Http\Controllers\API\ProfileMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/food', [AlternatifController::class, 'index']);
Route::post('/login', [AuthMobileController::class, 'login']);
Route::post('/register', [AuthMobileController::class, 'register']);
Route::post('/aras', [ArasMobileController::class, 'index']);
Route::put('/profile', [ProfileMobileController::class, 'Profile']);
