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
    }

    public function finalizarVenda(Request $request)
    {   
        $faturarProdutos = $request->input('faturarProdutos', []);
        $valorTotal = 0;

        foreach ($faturarProdutos as $dadosProduto) {
            $item = ItemVendaNfce::create([
                'codproduto' => $dadosProduto['id'],
                'nome' => $dadosProduto['nome'],
                'qte' => $dadosProduto['qte'],
                'preco_unitario' => $dadosProduto['preco_venda']
            ]);

            // Calcule o valor total
            $valorTotal += $dadosProduto['qte'] * $dadosProduto['preco_venda'];
        }

        // Criação da venda
        $venda = VendaNfce::create([
            'cod_cliente' => 1, // Certifique-se de obter o ID do cliente corretamente
            'valor_produto' => $valorTotal
        ]);
    
    }

}