<?php

namespace App\Http\Controllers\Api\V2\Pdv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumers;
use Illuminate\Http\JsonResponse;

class ConsumersController extends Controller
{
    public function index(): JsonResponse
    {
        $clientes = Consumers::all();
        return response()->json($clientes);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validate = $request->validate([
                'nome_completo' => 'required|string|max:255',
                'tipo_pessoa' => 'required|string',
                'cpf' => 'required|string|regex:/^\d{11}$/',
                'data_nascimento' => 'required|date',
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

    public function show(string $id): JsonResponse
    {
        $cliente = Consumers::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $cliente = Consumers::findOrFail($id);

        try {
            $validate = $request->validate([
                'nome_completo' => 'sometimes|required|string|max:255',
                'tipo_pessoa' => 'sometimes|required|string',
                'cpf' => 'sometimes|required|string|regex:/^\d{11}$/',
                'data_nascimento' => 'sometimes|required|date',
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

    public function destroy(string $id): JsonResponse
    {
        $cliente = Consumers::findOrFail($id);

        $cliente->delete();
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
