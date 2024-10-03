<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
//use App\Http\Controllers\Api\V2\MeController;

use App\Http\Controllers\Api\V2\pdv\ClientesController;
use App\Http\Controllers\Api\V2\pdv\ProdutosController;
use App\Http\Controllers\Api\V2\pdv\PDVController;

use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::prefix('v2')->group(function () {
    // Rotas de produtos
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

    Route::get('/pdv/buscar', [PDVController::class, 'busca']);
    Route::post('/pdv/buscar', [PDVController::class, 'busca']);
    
    Route::get('/pdv/teste', [PDVController::class, 'teste']);
    //Route::post('/pdv/buscar', [PDVController::class, 'teste']);

    Route::post('/pdv/finalizar', [PDVController::class, 'finalizar']);

});

JsonApiRoute::server('v2')->prefix('v2')->resources(function (ResourceRegistrar $server) {
    $server->resource('users', JsonApiController::class);
    Route::get('me', [MeController::class, 'readProfile']);
    Route::patch('me', [MeController::class, 'updateProfile']);

});
