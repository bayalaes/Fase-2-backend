<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AbonoController;
use App\Http\Controllers\AuthController;


// Rutas para Clientes
Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/clientes', [ClienteController::class, 'store']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

// Rutas para Productos
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

// Rutas para Abonos
Route::get('/abonos', [AbonoController::class, 'index']);
Route::post('/abonos', [AbonoController::class, 'store']);
Route::get('/abonos/{id}', [AbonoController::class, 'show']);
Route::put('/abonos/{id}', [AbonoController::class, 'update']);
Route::delete('/abonos/{id}', [AbonoController::class, 'destroy']);

// Rutas de autenticación
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user-profile', function () {
        // Ruta protegida por JWT
        return response()->json(['message' => 'Ruta protegida por JWT']);
    });
});