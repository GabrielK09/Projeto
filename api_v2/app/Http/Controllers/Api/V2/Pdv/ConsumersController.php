<?php
// By Kochem

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumers;

class ConsumerController extends Controller
{
    public function index()
    {
        $clientes = Consumers::all();
        return response()->json($clientes);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'nome_completo' => 'required|string|max:255',
                'tipo_pessoa' => 'required|string',
                'cpf' => 'required|string|min:11|max:11',
                'data_nascimento' => 'required|string',
                'tipo_cadastro' => 'required|string'
            ]);

            $cliente = Consumers::create($validate);

            return response()->json([
                'message' => 'Pessoa criada com sucesso!',
                'cliente' => $cliente
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar a pessoa!',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function show(string $id)
    {
        $cliente = Consumers::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
        return response()->json($cliente);
    }

    public function update(Request $request, string $id)
    {
        $cliente = Consumers::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        try {
            $validate = $request->validate([
                'nome_completo' => 'sometimes|required|string|max:255',
                'tipo_pessoa' => 'sometimes|required|string',
                'cpf' => 'sometimes|required|string|min:11|max:11',
                'data_nascimento' => 'sometimes|required|string',
                'tipo_cadastro' => 'sometimes|required|string'
            ]);

            $cliente->update($validate);

            return response()->json([
                'message' => 'Cliente atualizado com sucesso!',
                'cliente' => $cliente
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar o cliente!',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        $cliente = Consumers::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $cliente->delete();
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
