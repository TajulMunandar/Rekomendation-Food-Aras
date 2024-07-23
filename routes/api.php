<?php

use App\Http\Controllers\API\AlternatifController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/food', [AlternatifController::class, 'index']);
