<?php
// By Kochem

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Tclientes;

class ClientesController extends Controller
{
    public function clientes()
    {
        $clientes = Tclientes::all();
        return view('clientes.clientes', [
            'clientes' => $clientes
            
        ]);
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
    
            $cliente = Tclientes::create($validate);
            
            // Retprnp json
            // return response()->json([
            //     'message' => 'Pessoa criada com sucesso!',
            //     'cliente' => $cliente
    
            // ]);

            return redirect('/clientes')->with('sucess', 'Cliente cadastrado');

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
        $cliente = Tclientes::find($id);

        return view('clientes.editarCliente', [
            'cliente' => $cliente

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Tclientes::find($id);

        $cliente->update($request->all());


                                 // Tem que passar novamente pela validação dos campos
        return redirect()->route('clientes.store')->with('sucess', 'Produto deletado com sucessso!');

    }

    public function destroy(string $id)
    {
        
    }
}
