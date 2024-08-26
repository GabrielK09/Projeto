<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('main/home');

});

Route::get('/pedidos', [PedidosController::class, 'index']);
Route::get('/pedido/{id}', [PedidosController::class, 'getId']);
Route::get('/addItemTeste', [PedidosController::class, 'addItemTeste']);

Route::get('/cliente/{id}', [ClienteController::class, 'getId']);
Route::get('/addClienteTeste', [ClienteController::class, 'addClienteTeste']);