<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            return (Usuario::paginate(10));

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao recuperar produtos.',
                'message' => $th->getMessage()

            ], 500);
            
            
        };
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'login' => [
                    'string',
                    'required',
                    Rule::unique('usuarios')

                ],
                'senha' => 'required|string'
            ]);

            $usuario = Usuario::create($data);

            return response()->json([
                'message' => 'Usuario cadastrado com sucesso!',
                'usuario' => $usuario

            ], 201);
        } catch (Exception $e) {
              return response()->json([
                    'error' => 'Erro ao cadastrar produtos.',
                    'message' => $th->getMessage()

                ], 500);
             
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
