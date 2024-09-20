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
        $acrescimo = (float) $request->input('acrescimo', 0);
        $desconto = (float) $request->input('desconto', 0);
        $query = $request->input('query');
        $total = 0;

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

        //NÃO MEXER NESSE CARALHO AQUI EM BAIXO
        if ($produto) {
            $total += $produto->preco_venda;
    
            return view('nfce.pdv', [
                'produto' => $produto,
                'total' => max(0, $total + $acrescimo - $desconto),
                'query' => $query,
                'clientes' => Tclientes::all(),
                'message' => 'Produto inserido com sucesso!',
            ]);
        }

        //return redirect()->back()->with('message', 'Nenhum produto encontrado.');

        $total += $acrescimo;
        $total -= $desconto;

        $total = max(0, $total);

        $clientes = Tclientes::all();

        return view('nfce.pdv', [
            'produto' => $produto,
            'total' => max(0, $total),
            'query' => $query,
            'clientes' => $clientes,
        ])->with('message', 'Operação realizada com sucesso!');
    }
}