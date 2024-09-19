<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Tpessoas;

class PessoasController extends Controller
{
    public function pessoas()
    {
        //
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
    
            $pessoa = Tpessoas::create($validate);
            
            return response()->json([
                'message' => 'Pessoa criada com sucesso!',
                'pessoa' => $pessoa
    
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro!',
                'th' => $th
    
            ]);
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
