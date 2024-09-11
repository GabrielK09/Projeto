<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tprodutos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function produto()
    {
        try {
            $produtos = Tprodutos::all();

            return view('produto', [
                'produtos' => $produtos

            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Deu errok',
                'th' => $th->getMessage()
            
            ]);
        }

    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'nome' => 'required|string|max:255',
                'cod_gtin' => 'required|string|max:14|min:8',
                'preco_venda' => 'required|numeric|gt:0',
                'cfop' => 'required|numeric|gt:0',
                'csosn' => 'required|numeric|gt:0',
                'ncm' => 'required|numeric|gt:0',
                'qte' => 'required|numeric|gt:0'
                
            ]);
        
            Tprodutos::create($validate);
    
            return redirect('/produto')->with('success', 'Produto cadastrado com sucesso!');
         
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro',
                'th' => $th->getMessage()

            ], 500);
        };
    
    }
    
    public function show(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
