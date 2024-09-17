<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tprodutos;

class PDVController extends Controller
{
    public function pdv(Request $request)
    {
        $query = $request->input('query');
        $total = $request->input('total', 0);

        $produto = Tprodutos::where('id', 'like', '%' . $query . '%')
        ->orWhere('nome', 'like', '%' . $query . '%')
        ->first();

        if ($produto && $produto->ativo === 1) {
            $total += $produto->preco_venda;
        } else {
            $total = 0;
        }

        return view('nfce.pdv', [
            'produtos' => $produto,
            'total' => $total
        ])->with('message', 'Operação realizada com sucesso!');
    }
}
 