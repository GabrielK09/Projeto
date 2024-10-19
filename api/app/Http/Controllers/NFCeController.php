<?php

namespace App\Http\Controllers;

use LaravelJsonApi\Core\Document\Error;
//use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\ItemVendaNfce;
use App\Models\VendaNfce;
use App\Models\Clientes;
use App\Models\Estoque;
use App\Models\Caixa;

class NFCeController extends Controller  
{
    public function adicionar(Request $request) {
        $produtos = Estoque::paginate(10);

        return response()->json($produtos);

    }

    public function carrinho(Request $request)
    {
        $produtosSelecionados = $request->input('produtosSelecionados', []); // Aqui pega tudo que ta sendo selecionado nessa merda

        $produtos[] = $produtosSelecionados;
        
        foreach ($produtosSelecionados as $produto) {
            $produtos[] = $produto;
        }

        return response()->json([
            'resposta' => 'RESPOSTA DO BACKKKKKKK',
            'teste_nome' => $produtos
        ]);
    }

    public function finalizarVenda(Request $request)
    {   
        $faturarProdutos = $request->input('faturarProdutos');

        return response()->json($faturarProdutos);

    }

}