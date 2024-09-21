<?php
// By Kochem

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tprodutos;
use App\Services\ItemVendaNFCe;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        try {
            $produtos = Tprodutos::paginate(20);
            return response()->json($produtos);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao recuperar produtos.',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nome' => 'required|string|max:255',
            'qte' => 'required|numeric|gt:0',
            'cod_gtin' => 'required|string|max:14|min:8',
            'preco_venda' => 'required|numeric|gt:0',
            'cfop' => 'required|numeric|gt:0',
            'csosn' => 'required|numeric|gt:0',
            'ncm' => 'required|numeric|gt:0',
        ]);

        $produto = Tprodutos::create($validate);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'produto' => $produto
        ], 201);
    }

    public function show(string $id)
    {
        $produto = Tprodutos::findOrFail($id);
        return response()->json($produto);
    }

    public function update(Request $request, string $id)
    {
        $produto = Tprodutos::findOrFail($id);
        $produto->update($request->all());

        return response()->json([
            'message' => 'Produto alterado com sucesso!',
            'produto' => $produto
        ]);
    }

    public function inativar(string $id)
    {
        $produto = Tprodutos::findOrFail($id);
        $produto->ativo = false;
        $produto->save();

        return response()->json([
            'message' => 'Produto inativado com sucesso!',
        ]);
    }

    public function ativar(string $id)
    {
        $produto = Tprodutos::findOrFail($id);
        $produto->ativo = true;
        $produto->save();

        return response()->json([
            'message' => 'Produto ativado com sucesso!',
        ]);
    }

    public function addItemVenda(Request $request, ItemVendaNFCe $itemVendaNFCe)
    {
        $request->validate([
            'produto_id' => 'required|exists:tprodutos,id',
            'qte' => 'required|integer|min:1'
        ]);

        $produtoId = $request->input('produto_id');
        $qte = $request->input('qte');

        if ($itemVendaNFCe->addProduto($produtoId, $qte)) {
            return response()->json([
                'message' => 'Item adicionado com sucesso!'
            ]);
        }

        return response()->json([
            'message' => 'Erro ao adicionar item.'
        ], 500);
    }
}
