<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consumers;
use App\Models\Products;
use LaravelJsonApi\Core\Document\Error;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use Illuminate\Http\Request;

class SaleNfceController extends JsonApiController
{
    public function pdv(Request $request)
    {
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
            $produto = Products::where('id', 'like', '%' . $query . '%')
                ->orWhere('nome', 'like', '%' . $query . '%')
                ->where('ativo', 1)
                ->first();
        }

        if ($produto) {
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

    public function cancelarVenda()
    {
        session()->forget('produtos');

        return $this->reply()->success([
            'message' => 'Venda cancelada!'
        ]);
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $clientes = Consumers::where('nome', 'like', '%' . $query . '%')->get();

        return $this->reply()->success([
            'clientes' => $clientes
        ]);
    }
}
