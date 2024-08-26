<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function allClientes(){
        $query = Cliente::all();

    }

    public function getId($id) {
        $cliente = Cliente::findOrFail($id);

        return view('idCliente', ['cliente' => $query]);

    }

    public function addClienteTeste() {
        $new_cliente = new Cliente;

        $new_cliente->name = 'Cliente 1';
        $new_cliente->telefone = '+55 49 999999999';
        $new_cliente->cpf = '123.456.789-01';
        $new_cliente->cnpj = '';
        $new_cliente->save();

        return response()->json([
            'message' => 'Pedido inserido com sucesso!',
            'cliente' => $new_cliente
        ], 201);
    }
}
