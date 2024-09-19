<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tprodutos;
use App\Models\Titemvendanfce;

use App\Services\ItemVendaNFCe;

class PDVController extends Controller
{
    public function pdv(Request $request)
    {
        $acrescimo = $request->input('acrescimo');
        $acrescimo = $request->input('desconto');
        $query = $request->input('query');
        $total = $request->input('total', 0);

        $produto = Tprodutos::where('id', 'like', '%' . $query . '%')
                                    ->orWhere('nome', 'like', '%' . $query . '%')
                                    ->first();

<<<<<<< HEAD
        if ($query != null && $produto && $produto->ativo === 1) {
            $total += $produto->preco_venda;
=======
        


        if ($query != null && $produto && $produto->ativo === 1) {
            $itemVenda->addProduto($produto->id);
            $total += $produto->preco_venda;
            
>>>>>>> 594fe6a0c65af31c5a29764f6d4bb847c092fb9b
        } 

        return view('nfce.pdv', [
            'produto' => $produto,
            'total' => $total

        ])->with('message', 'Operação realizada com sucesso!');

    }

    public function addItemVenda(Request $request, ItemVendaNFCe $itemVendaNFCe) {
        $request->validate([
            'produto_id' => 'required|exists:tprodutos,id',
            'qte' => 'required|integer|min:1'
        ]);

        $produtoId = $request->input('produto_id');
        $qte = $request->input('qte');
        
        if ($itemVendaNFCe->addProduto($produtoId, $qte)) {
            return response()->json([
                'message' => 'item aqui'
            ]);
        }
    }

}