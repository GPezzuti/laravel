<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum', CheckAdminRole::class); */

Route::middleware(['auth:sanctum', CheckAdminRole::class])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/photos', [PhotoController::class, 'index']);
    // Otras rutas protegidas para administradores aquí
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

// Ruta para login
Route::post('/login', [AuthController::class, 'login']);

// Ruta para logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/photo', [PhotoController::class, 'store'])->middleware('auth:sanctum');

