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
        $validate = $request->validate([
            'nome' => 'required|string|max:255',
            'qte' => 'required|numeric|gt:0',
            'cod_gtin' => 'required|string|max:14|min:8',
            'preco_venda' => 'required|numeric|gt:0',
            'cfop' => 'required|numeric|gt:0',
            'csosn' => 'required|numeric|gt:0',
            'ncm' => 'required|numeric|gt:0',
                
        ], [
            'nome.required' => 'O nome precisa ser preenchido.',

            'qte.required' => 'A quantia precisa ser preenchida',
            'qte.gt' => 'A quantia precisa ser maior que 0',
            'qte.numeric' => 'A quantia precisa ser um número',
            
            'cod_gtin.required' => 'O código GTIN precisa ser preenchido',
            'cod_gtin.min' => 'O código GTIN deve ter pelo menos 8 caracteres',
            'cod_gtin.max' => 'O código GTIN deve ter no máximo 14 caracteres',
            'cod_gtin.numeric' => 'O código GTIN precisa ser um númro',
        
            'preco_venda.required' => 'O preço de vendd precisa ser preenchido.',
            'preco_venda.gt' => 'O preço de venda deve ser maior que 0.',
            'preco_venda.numeric' => 'O preço de venda precisa ser um número.',

            'cfop.required' => 'O CFOP precisa ser preenchido.',
            'cfop.max' => 'O CFOP deve ter no máximo 4 caracteres'             

        ]);
        
        Tprodutos::create($validate);
    
        return redirect('/produto')->with('success', 'Produto cadastrado com sucesso!');
         
    }
    
    public function show(string $id)
    {
        $produto = Tprodutos::findOrFail($id);

        return view('editarProduto', [
            'produto' => $produto
        ]);

    }

    public function update(Request $request, string $id)
    {
        $produto = Tprodutos::findOrFail($id);

        $produto->update($request->all());

        return redirect()->route('produto.store')->with('sucess', 'Produto alterado com sucessso!');
    }

    public function destroy(string $id)
    {
        
    }
}
