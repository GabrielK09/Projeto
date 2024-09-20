<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tprodutos;

use App\Models\Tclientes;

class PDVController extends Controller
{
    public function pdv(Request $request)
    {
        $produtos = session('produtos', []);
        $acrescimo = (float) $request->input('acrescimo', 0);
        $desconto = (float) $request->input('desconto', 0);
        $query = $request->input('query');
        $total = array_sum(array_column($produtos, 'preco_venda'));
        
        if ($acrescimo && $desconto) {
            return redirect()->back()->with('message', 'Você não pode inserir acréscimo e desconto ao mesmo tempo.');
        }
    
        $produto = null;
        if ($query) {
            $produto = Tprodutos::where('id', 'like', '%' . $query . '%')
                                ->orWhere('nome', 'like', '%' . $query . '%')
                                ->where('ativo', 1)
                                ->first();
        }
    
        if ($produto) {
            if (!in_array($produto, $produtos)) {
                $produtos[] = $produto;
                session(['produtos' => $produtos]);
            }
        
            $total += $produto->preco_venda;
        
            return view('nfce.pdv', [
                'produtos' => $produtos,
                'total' => max(0, $total + $acrescimo - $desconto),
                'query' => $query,
                'clientes' => Tclientes::all(),
                'message' => 'Produto inserido com sucesso!',
            ]);
        }
    
        return view('nfce.pdv', [
            'produtos' => $produtos,
            'total' => max(0, $total + $acrescimo - $desconto),
            'query' => $query,
            'clientes' => Tclientes::all(),
            'message' => 'Nenhum produto encontrado.',
        ]);
    }
}   