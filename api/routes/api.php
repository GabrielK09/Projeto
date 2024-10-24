<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\NFCeController;

Route::get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

// Rotas produtos
Route::get('/produto', [ProdutosController::class, 'index']);
Route::post('/produto', [ProdutosController::class, 'store']);

//----------------

// Rotas clientes
Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);

Route::get('/clientes/verificar', [ClientesController::class, 'verifica']);

//----------------

// Rotas Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);

//----------------


// Rotas - VENDAS
Route::get('/nfce/adicionar', [NFCeController::class, 'adicionar']);

Route::get('/nfce/carrinho', [NFCeController::class, 'carrinho']);
Route::post('/nfce/carrinho', [NFCeController::class, 'carrinho']);

// Route::get('/nfce/adicionar-cliente', [NFCeController::classs, '']);
// Route::post('/nfce/adicionar-cliente', [NFCeController::classs, '']);

Route::get('/nfce/finalizar', [NFCeController::class, 'finalizarVenda']);
Route::post('/nfce/finalizar', [NFCeController::class, 'finalizarVenda']);

//----------------