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

        $produtos = null;
        $total = $request->input('total', 0);

        if ($query) {
            $produtos = Tprodutos::where('id', 'like', '%' . $query . '%')
                ->orWhere('nome', 'like', '%' . $query . '%')
                ->first();

            if ($produtos && is_object($produtos) && $produtos->ativo === 1) {
                $total += $produtos->preco_venda; 
                    
            } 
                    
        };

        return view('nfce.pdv', [
            'produtos' => $produtos,
            'total' => $total
            
        ]);
    }
}
 