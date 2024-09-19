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
        $total = (float) $request->input('total', 0);

        $acrescimo = is_numeric($acrescimo) ? floatval($acrescimo) : 0;
        $desconto = is_numeric($desconto) ? floatval($desconto) : 0;

        $produto = Tprodutos::where('id', 'like', '%' . $query . '%')
                                    ->orWhere('nome', 'like', '%' . $query . '%')
                                    ->first();

        if ($query != null && $produto && $produto->ativo === 1) {
            $total += $produto->preco_venda;
        } 

        $total += $acrescimo;
        $total -= $desconto;

        $total = max(0, $total);

        $clientes = Tclientes::all();

        return view('nfce.pdv', [
            'produto' => $produto,
            'total' => max(0, $total),
            'query' => $query,
            'clientes' => $clientes

        ])->with('message', 'Operação realizada com sucesso!');

    }

}