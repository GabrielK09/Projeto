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
    public function finalizarVenda(Request $request)
{
    // Valida os dados de entrada
    $validated = $request->validate([
        'forma_pagamento' => 'required|string|max:100',
        'acrescimo' => 'numeric|min:0',
        'desconto' => 'numeric|min:0',
        'produtos' => 'required|array', // Certifique-se de que há produtos na venda
    ]);

    // Pega os produtos da sessão
    $produtos = $request->input('produtos', []);
    $acrescimo = (float) $request->input('acrescimo', 0);
    $desconto = (float) $request->input('desconto', 0);

    // Calcula o total da venda
    $total = collect($produtos)->sum('preco_venda') + $acrescimo - $desconto;
    $total = max(0, $total); // Garante que o valor total não seja negativo

    // Inicia a transação para garantir a integridade dos dados
    DB::beginTransaction();

    try {
        // Cria a venda
        $venda = VendaNfce::create([
            'valorproduto' => $total,
            'cod_cliente' => 1, // Exemplo de cliente (pode ser obtido do request)
            'forma_pagamento' => $validated['forma_pagamento'],
            'acrescimo' => $acrescimo,
            'desconto' => $desconto,
        ]);

        // Adiciona cada produto à tabela de itens da venda
        foreach ($produtos as $produto) {
            ItemVendaNfce::create([
                'cod_produto' => $produto['id'],
                'quantidade' => $produto['qte'],
                'preco_venda' => $produto['preco_venda'],
                'venda_nfce_id' => $venda->id, // Associa o item à venda
            ]);
        }

        // Atualiza o caixa com a nova venda
        Caixa::create([
            'origem' => 'Venda NFCe',
            'cod_vendanfce' => $venda->id,
            'valorentrada' => $total,
            'cod_cliente' => 1, // Exemplo de cliente (pode ser obtido do request)
            'cliente' => 'Cliente de Teste', // Exemplo (pode ser substituído pelo nome do cliente)
            'descricao_lancamento' => "Venda NFC {$venda->id}",
        ]);

        // Confirma a transação
        DB::commit();

        // Esvazia os produtos da sessão
        session()->forget('produtos');

        // Retorna uma resposta de sucesso
        return response()->json([
            'message' => 'Venda finalizada com sucesso!',
            'venda_id' => $venda->id,
            'total' => $total,
        ]);
    } catch (\Exception $e) {
        // Em caso de erro, reverte a transação
        DB::rollBack();

        // Retorna uma resposta de erro
        return response()->json([
            'message' => 'Erro ao finalizar a venda. Por favor, tente novamente.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}