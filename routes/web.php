<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\PDVController;

Route::get('/', function () {
    return view('dashboard');

});

Route::get('/produto', [ProdutosController::class, 'produto']);
Route::post('/produto', [ProdutosController::class, 'store'])->name('produto.store');

Route::get('/produto/cadastro', function() {
    return view('cadastroProduto');

});


Route::get('/pdv', [PDVController::class, 'pdv']);
Route::get('/pdv', [PDVController::class, 'pdv']);