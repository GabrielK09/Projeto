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
   public function pdv(Request $request)
   {
       $validated = $request->validate([
           'forma_pagamento' => 'required|string|max:100',
           'acrescimo' => 'numeric|min:0',
           'desconto' => 'numeric|min:0',
       ]);

       $produtos = session('produtos', []);
       $acrescimo = (float) $request->input('acrescimo', 0);
       $desconto = (float) $request->input('desconto', 0);
       $query = $request->input('query');

       if ($acrescimo && $desconto) {
           return $this->reply()->errors([
               Error::fromArray([
                   'status' => '400',
                   'title' => 'Bad Request',
                   'detail' => 'Você não pode inserir acréscimo e desconto ao mesmo tempo.'
               ])
           ]);
       }

       $produto = null;

       if ($query) {
           $produto = Estoque::where('ativo', 1)
               ->where(function ($queryBuilder) use ($query) {
                   $queryBuilder->where('id', 'like', '%' . $query . '%')
                         ->orWhere('nome', 'like', '%' . $query . '%');
            })
            ->first();
        }

        if ($produto) {
            ItemVendaNfce::create([
                'cod_produto' => $produto->id,
                'nome' => $produto->nome
            
            ]);

            if (!in_array($produto->id, array_column($produtos, 'id'))) {
                $produtos[] = $produto;
                session(['produtos' => $produtos]);
            }

            $total = array_sum(array_column($produtos, 'preco_venda')) + $produto->preco_venda;

            return $this->reply()->success([
                'produtos' => $produtos,
                'total' => max(0, $total + $acrescimo - $desconto),
                'message' => 'Produto inserido com sucesso!'
            ]);
        }

        return $this->reply()->success([
            'produtos' => $produtos,
            'total' => max(0, array_sum(array_column($produtos, 'preco_venda')) + $acrescimo - $desconto),
            'message' => 'Nenhum produto encontrado.'
        ]);
    }

    // Não foi usado

    public function cancelarVenda()
    {
        session()->forget('produtos');

        return $this->reply()->success([
            'message' => 'Venda cancelada!'
        ]);

    }

    // public function buscar(Request $request)
    // {
    //     $query = $request->input('query');
    //     $clientes = Clientes::where('nome', 'like', '%' . $query . '%')->get();

    //     return $this->reply()->success([
    //         'clientes' => $clientes
    //     ]);
    // }

    // Não foi usado


    public function finalizar(Request $request) 
    {


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

    public function index()// : JsonResponse
    {
        $teste = "aaaaaaa";
        return response()->json([
            'message' => 'Teste',
            'teste' => $teste   

        ]);
        
    }
}