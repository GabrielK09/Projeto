<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tprodutos;
<<<<<<< HEAD
=======
use App\Models\Tpessoas;
>>>>>>> 0a4453a19bd407e1c203e1e90c4f8314d2e555e1

class PDVController extends Controller
{
    public function pdv(Request $request)
    {
        $acrescimo = $request->input('acrescimo');
        $desconto = $request->input('desconto');
        $query = $request->input('query');
        $total = $request->input('total', 0);

        $produto = Tprodutos::where('id', 'like', '%' . $query . '%')
                                    ->orWhere('nome', 'like', '%' . $query . '%')
                                    ->first();

<<<<<<< HEAD
        if ($query != null && $produto->ativo === 1) {
=======
        if ($query != null && $produto && $produto->ativo === 1) {
>>>>>>> 0a4453a19bd407e1c203e1e90c4f8314d2e555e1
            $total += $produto->preco_venda;
        } 

        $total += $acrescimo;
        $total -= $desconto;

        $pessoas = Tpessoas::all();

        return view('nfce.pdv', [
            'produto' => $produto,
            'total' => max(0, $total),
            'query' => $query,
            'pessoas' => $pessoas

        ])->with('message', 'Operação realizada com sucesso!');

    }

}