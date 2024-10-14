<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;

Route::middleware('api')->get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

Route::get('/produto', [ProdutosController::class, 'index']);
Route::post('/produto', [ProdutosController::class, 'store']);

Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);