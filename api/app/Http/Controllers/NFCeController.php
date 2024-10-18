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
        $produtosSelecionados = $request->input('produtos');
        foreach ($produtosSelecionados as $produto) {
            $produto = $produto;
        }

        $venda = VendaNfce::create([
            'cod_cliente' => 1,
            'produto' => 'produto' ,
            'valor_produto' => 1

        ]);

        try{
            return response()->json([
                'Produtos' => 'Todos os produtos',
                'produtosSelecionados' => $produtosSelecionados,
                'venda' => $venda

            ]);            

        } catch(Exception $e) {
            return response()->json([
                'Error' => 'Sem produtos adicionados',
                'e' => $e

            ]);

        }   
    }

}