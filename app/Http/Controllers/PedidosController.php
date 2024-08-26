<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;

use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index() {
        $query = Pedido::all();

        return view('allPedidos', ['query' => $query]);
    }

    public function getId($id) {
        $pedido = Pedido::findOrFail($id);
        
        return view('idPedido', ['pedido' => $pedido]);

    }

    public function addItemTeste() {
        $pedido = new Pedido;

        $pedido->item = 'Notebook';
        $pedido->descricao = "O equipamento não está ligando após uma queda de energia do bairro";
        $pedido->preview = "Não está ligando";
        $pedido->status = 'Aberto';
        $pedido->modelo = 'Acer Nitro 5';
        $pedido->tecnico = 'Gabriel K.';
        $pedido->save();

        return response()->json([
            'message' => 'Pedido inserido com sucesso!',
            'pedido' => $pedido
        ], 201);
    }
}
