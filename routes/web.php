<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PDVController;
use App\Http\Controllers\PessoasController;

Route::get('/', function () {
    return view('dashboard.dashboard');

}); // <- Home



// Rota PDV ( EM TESTES )
Route::get('/pdv', [PDVController::class, 'pdv']);
Route::post('/produto', [ProdutosController::class, 'addItemVenda'])->name('produto.store'); //<- Cadastrar produtos

// ------------------------


// Rotas dos produtos
Route::get('/produto', [ProdutosController::class, 'produto']); //<- Todos os produtos
Route::post('/produto', [ProdutosController::class, 'store'])->name('produto.store'); //<- Cadastrar produtos
Route::get('/produto/cadastro', function() {
    return view('produtos.cadastroProduto');

}); //<- Apenas renderiza o forms do cadastro

Route::get('/produto/editar/{id}', [ProdutosController::class, 'show']); //<- Mostrar o produto pelo ID
Route::put('produto/{id}', [ProdutosController::class, 'update']); // <- Editar o produto

Route::post('/produto/{id}/inativar', [ProdutosController::class, 'inativar'])->name('produto.inativar'); // <- Inativar
Route::post('/produto/{id}/ativar', [ProdutosController::class, 'ativar'])->name('produto.ativar'); // <- Inativar

// --------------------


// Rotas pessoas
Route::get('/pessoas', function () {
    return view('pessoas.pessoas');
});

Route::get('/pessoas/cadastro', function () {
    return view('pessoas.cadastroPessoa');
     
});
Route::post('/pessoas', [PessoasController::class, 'store'])->name('pessoas.store');

// --------------------