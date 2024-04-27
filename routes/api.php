<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); 

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    });


// Ruta para registro
// Route::post('/register', [AuthController::class, 'register']);

// Ruta para registro
Route::post('/register', [UserController::class, 'store']);


// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class, 'store']);
// Route::get('/users/{user}', [UserController::class, 'show']);
// Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth:sanctum');
// Route::delete('/users/{user}', [UserController::class, 'destroy']);

// Ruta para login
Route::post('/login', [AuthController::class, 'login']);

// Ruta para logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::post('/photo', [PhotoController::class, 'store'])->middleware('auth:sanctum');

