<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PDVController;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return view('dashboard.dashboard');

}); // <- Home


// Rota PDV ( EM TESTES )
Route::get('/pdv', [PDVController::class, 'pdv'])->name('pdv'); // <- Tela NFCe
Route::post('/pdv/cancelar', [PDVController::class, 'cancelarVenda'])->name('pdv.cancelar'); // <- Cancelar venda

// ------------------------


// Rotas dos produtos
Route::get('/produto', [ProdutosController::class, 'produto']); //<- Todos os produtos
Route::post('/produto', [ProdutosController::class, 'store'])->name('produto.store'); //<- Cadastrar produtos
Route::get('/produto/cadastro', function() { // <- Apenas renderiza o forms do cadastro
    return view('produtos.cadastroProduto');
}); 

Route::get('/produto/editar/{id}', [ProdutosController::class, 'show']); //<- Mostrar o produto pelo ID
Route::put('produto/{id}', [ProdutosController::class, 'update']); // <- Editar o produto

Route::post('/produto/{id}/inativar', [ProdutosController::class, 'inativar'])->name('produto.inativar'); // <- Inativar
Route::post('/produto/{id}/ativar', [ProdutosController::class, 'ativar'])->name('produto.ativar'); // <- Inativar

// --------------------


// Rotas clientes
Route::get('/clientes', function () { // <- Puxar os clientes
    return view('clientes.clientes');
});

Route::get('/clientes/cadastro', function () { // <- Rederiza tela de cadastro
    return view('clientes.cadastroClientes');
     
});

Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes/buscar', [PDVController::class, 'buscar'])->name('clientes.buscar');

// --------------------