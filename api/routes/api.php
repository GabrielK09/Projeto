<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;

Route::get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

Route::get('/produto', [ProdutosController::class, 'index'])->name('produto.index');

Route::get('/produto/{id}', [ProdutosController::class, 'show']);