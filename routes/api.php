<?php

use App\Http\Controllers\API\AlternatifController;
use App\Http\Controllers\API\AuthMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/food', [AlternatifController::class, 'index']);
Route::post('/login', [AuthMobileController::class, 'login']);
Route::post('/register', [AuthMobileController::class, 'login']);
