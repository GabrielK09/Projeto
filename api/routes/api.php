<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;

use App\Http\Controllers\NFCeController;

Route::get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

Route::get('/produto', [ProdutosController::class, 'index']);
Route::post('/produto', [ProdutosController::class, 'store']);

Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);
