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

        $produtos = [];
        $ids = [];
        foreach ($produtosSelecionados as $dadosProduto) {
            $produtos[] = [
                'id' => $dadosProduto['id'],
                'nome' => $dadosProduto['nome'],
                'qte' => $dadosProduto['qte'],
                'preco_venda' => $dadosProduto['preco_venda']

            ];

              
            $itensDaVenda = ItemVendaNfce::create([
                'codproduto' => $dadosProduto['id'],
                'nome' => $dadosProduto['nome'],
                'qte' => $dadosProduto['qte'],
                'preco_unitario' => $dadosProduto['preco_venda']

            ]);
        }

   

       // $venda = ItemVendaNfce::create([
       //      'codproduto' => $produtos['id'],
       //      'nome' => $produtos['nome'],
       //      'qte' => $produtos['qte']

       //  ]);

        

    }

    public function finalizarVenda(Request $request)
    {   
        $faturarProdutos = $request->input('faturarProdutos');

        return response()->json($faturarProdutos);

    }

}