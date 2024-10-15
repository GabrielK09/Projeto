<?php
// By Kochem
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;

use App\Http\Controllers\NFCeController;

Route::get('/teste', function () {
    return response()->json(['message' => 'API funcionando!']);

});

    Route::get('/produto', [ProdutosController::class, 'index'])->name('produto.index'); // Listar produtos
    Route::post('/produto', [ProdutosController::class, 'store'])->name('produto.store'); // Criar produto
    Route::get('/produto/{id}', [ProdutosController::class, 'show'])->name('produto.show'); // Mostrar produto
    Route::patch('/produto/{id}', [ProdutosController::class, 'update'])->name('produto.update'); // Atualizar produto
    Route::post('/produto/{id}/ativar', [ProdutosController::class, 'ativar'])->name('produto.ativar'); // Deletar produto
    Route::post('/produto/{id}/inativar', [ProdutosController::class, 'inativar'])->name('produto.inativar'); // Deletar produto


    // Rotas de consumidores
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index'); // Listar todos os consumidores
    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store'); // Criar um novo consumidor
    Route::get('/clientes/{id}', [ClientesController::class, 'show'])->name('clientes.show'); // Mostrar um consumidor específico
    Route::patch('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update'); // Atualizar um consumidor específico
    Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy'); // Deletar um consumidor específico

    // Rota de vendas

    Route::get('/busca', [NFCeController::class, 'busca']);
    Route::get('/busca/{id}', [NFCeController::class, 'buscaId']);
    Route::get('/itemSelecionado', [NFCeController::class, 'itemSelecionado']);