<?php

namespace App\Http\Controllers\Api\V2\Pdv;

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

class PDVController extends Controller  
{
    public function finalizarVenda2(Request $request) 
    {
        $teste = '200 OK';
        return response()->json([
            'message' => "Api bonbando",
            'teste' => $teste 

        ]); 
        
        
    }
    
    public function finalizarVenda(Request $request){

        // Se não der pau, comenta, se der pau descomenta
        $produtos = session('produtos', []);
        $acrescimo = (float) $request->input('acrescimo', 0);
        $desconto = (float) $request->input('desconto', 0);

        //$formapagamento = $request->input('tyikjnryijnr');

        $total = collect($produtos)->sum('preco_venda') + $acrescimo - $desconto;
        $total = max(0, $total);

        $venda = VendaNfce::create([
            'valorproduto' => $total,
            'cod_cliente' => 1,
            'produto' => $produtos['nome'],
            'valor_produto' => $produtos->preco_venda
            //'forma_pagamento' => $formapagamento,
            
        ]);

        foreach($produtos as $produtos){
            ItemVendaNfce::create([
                'cod_produto' => $produto['id'],
                'quantidade' => $produto['qte'],
                'preco_venda' => $produto['preco_venda'],

            ]);

        }

        Caixa::create([
            'origem' => 'Venda NFCe',
            'cod_vendanfce' => $venda->id,
            'valorentrada' => $total,
            'valorentrada' => 0,
            'cod_cliente' => 1, // $cliente->id
            'cliente' => 'Teste vendan NFCe', // $cliente->nome_completo
            'descricao_lancamento' => "NFC {$venda->id}"

        ]);

        session()->forget('produtos');

        // return $this->reply()->success([
        //     'message' => 'Venda finalizada com sucesso!',
        //     'total' => $total,
        //     'cod_produto' => $venda->id, 

        // ]);

        $teste = "aaaaaaa";
        return response()->json([
            'message' => 'Teste',
            'teste' => $teste   

        ]);
    }
}