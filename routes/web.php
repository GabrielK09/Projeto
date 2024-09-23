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



//Funcional, mas só retorna o cliente para a view
Route::get('/pdv/c', [PDVController::class, 'buscar'])->name('pdv2');

// ------------------------


// Rotas dos produtos
Route::get('/produto', [ProdutosController::class, 'produto']); //<- Todos os produtos
Route::post('/produto', [ProdutosController::class, 'store'])->name('produto.store'); //<- Cadastrar produtos

Route::get('/produto/cadastro', function() { // <- Apenas renderiza o forms do cadastro do produto
    return view('produtos.cadastroProduto');

}); 

Route::get('/produto/editar/{id}', [ProdutosController::class, 'show']); //<- Mostrar o produto pelo ID
Route::put('produto/{id}', [ProdutosController::class, 'update']); // <- Editar o produto

Route::post('/produto/{id}/inativar', [ProdutosController::class, 'inativar'])->name('produto.inativar'); // <- Inativar
Route::post('/produto/{id}/ativar', [ProdutosController::class, 'ativar'])->name('produto.ativar'); // <- Ativar

// --------------------


// Rotas pessoas
Route::get('/clientes', [ClientesController::class, 'clientes']); //<- Todos os cliente

Route::get('/clientes/cadastro', function () { // <- Apenas renderiza o forms do cadastro do cliente
    return view('clientes.cadastroClientes');

});

Route::get('/cliente/editar/{id}', [ClientesController::class, 'show']); //<- Mostrar o cliente pelo ID
Route::put('cliente/{id}', [ClientesController::class, 'update']); // <- Edita o cliente

Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');

// --------------------