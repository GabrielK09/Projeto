<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;

Route::middleware('api')->get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

Route::get('/produto', [ProdutosController::class, 'index']);