<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clientes;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

class ClientesController extends Controller
{
    public function index(): JsonResponse
    {
      
        try {
            $clientes = Clientes::all();
            return response()->json($clientes);

            
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao carregar os clientes.',
                'message' => $th->getMessage()

            ], 500);
            
        }

    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validate = $request->validate([
                'nome_completo' => 'required|string|max:100',
                'tipo_pessoa' => 'required|string',

                'cpf' => [
                            'required_if:tipo_pessoa,1',
                            'nullable',
                            Rule::unique('clientes')
                        ],

                'cnpj' => [
                            'required_if:tipo_pessoa,2',
                            'nullable',
                            Rule::unique('clientes')
                        ],

                'data_nascimento' => 'required|date',
                'tipo_cadastro' => 'required|integer'
                
            ]);

            $cliente = Clientes::create($validate);

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
        $cliente = Clientes::findOrFail($id);
        return response()->json($cliente);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $cliente = Clientes::findOrFail($id);

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
        $cliente = Clientes::findOrFail($id);

        $cliente->delete();
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
