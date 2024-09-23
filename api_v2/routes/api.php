<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use App\Http\Controllers\Api\V2\Auth\LoginController;
use App\Http\Controllers\Api\V2\Auth\LogoutController;
use App\Http\Controllers\Api\V2\Auth\RegisterController;
use App\Http\Controllers\Api\V2\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V2\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V2\MeController;
use App\Http\Controllers\Api\V2\Pdv\ClientesController;
use App\Http\Controllers\Api\V2\Pdv\ConsumersController;
use App\Http\Controllers\Api\V2\Pdv\ProductsController;
use App\Http\Controllers\Api\V2\Pdv\ProdutosController;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v2')->middleware('json.api')->group(function () {
    // Rotas de autenticação
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class); // Removido o middleware
    Route::post('/register', RegisterController::class);
    Route::post('/password-forgot', ForgotPasswordController::class);
    Route::post('/password-reset', ResetPasswordController::class)->name('password.reset');
});


Route::prefix('v2')->group(function () {
    // Rotas de consumidores
    Route::get('/consumidor', [ClientesController::class, 'index'])->name('consumers.index'); // Listar todos os consumidores
    Route::post('/consumidor', [ClientesController::class, 'store'])->name('consumers.store'); // Criar um novo consumidor
    Route::get('/consumidor/{id}', [ClientesController::class, 'show'])->name('consumers.show'); // Mostrar um consumidor específico
    Route::patch('/consumidor/{id}', [ClientesController::class, 'update'])->name('consumers.update'); // Atualizar um consumidor específico
    Route::delete('/consumidor/{id}', [ClientesController::class, 'destroy'])->name('consumers.destroy'); // Deletar um consumidor específico

    // Rotas de produtos
    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index'); // Listar produtos
    Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store'); // Criar produto
    Route::get('/produtos/{id}', [ProdutosController::class, 'show'])->name('produtos.show'); // Mostrar produto
    Route::patch('/produtos/{id}', [ProdutosController::class, 'update'])->name('produtos.update'); // Atualizar produto
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy'])->name('produtos.destroy'); // Deletar produto




});

JsonApiRoute::server('v2')->prefix('v2')->resources(function (ResourceRegistrar $server) {
    $server->resource('users', JsonApiController::class);
    Route::get('me', [MeController::class, 'readProfile']);
    Route::patch('me', [MeController::class, 'updateProfile']);
});
