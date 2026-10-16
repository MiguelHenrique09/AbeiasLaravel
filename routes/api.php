<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PedidoControllerApp;
use App\Http\Controllers\Api\ProdutoControllerApp;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/produtos', [ProdutoControllerApp::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/pedidos', [PedidoControllerApp::class, 'index']);
    Route::post('/pedidos', [PedidoControllerApp::class, 'store']);
});