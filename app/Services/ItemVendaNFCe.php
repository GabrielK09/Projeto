<?php

namespace App\Services;

use App\Models\Titemvendanfce;
use App\Models\Tprodutos;

class ItemVendaNFCe
{
    public function addProduto($produtoId, $qte) {
        $produto = Tprodutos::find($produtoId);

        if($produto) {
            $precoUnitario = $produto->preco_venda;
            $total = $qte * $precoUnitario;

            $itemVenda = new Titemvendanfce();
            $itemVenda->produto_id = $produtoId;
            $itemVenda->qte = $qte;
            $itemVenda->preco_unitario = $precoUnitario;
            $itemVenda->total = $total;
            $itemVenda->save();

            return true;

        }

        return false;
    }
}