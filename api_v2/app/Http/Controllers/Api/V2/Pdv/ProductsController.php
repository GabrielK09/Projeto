<?php
// By Kochem

namespace App\Http\Controllers\Api\V2\Pdv;


use App\Http\Controllers\Controller;
use App\Models\ItemSaleNfce;
use App\Models\Products;
//use App\Services\Item;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        try {
            $produtos = Products::paginate(20);
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

        $produto = Products::create($validate);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'produto' => $produto
        ], 201);
    }

    public function show(string $id)
    {
        $produto = Products::findOrFail($id);
        return response()->json($produto);
    }

    public function update(Request $request, string $id)
    {
        $produto = Products::findOrFail($id);
        $produto->update($request->all());

        return response()->json([
            'message' => 'Produto alterado com sucesso!',
            'produto' => $produto
        ]);
    }

    public function inativar(string $id)
    {
        $produto = Products::findOrFail($id);
        $produto->ativo = false;
        $produto->save();

        return response()->json([
            'message' => 'Produto inativado com sucesso!',
        ]);
    }

    public function ativar(string $id)
    {
        $produto = Products::findOrFail($id);
        $produto->ativo = true;
        $produto->save();

        return response()->json([
            'message' => 'Produto ativado com sucesso!',
        ]);
    }

    public function addItemVenda(Request $request, ItemSaleNfce $itemSaleNfce)
    {
        $request->validate([
            'produto_id' => 'required|exists:tprodutos,id',
            'qte' => 'required|integer|min:1'
        ]);

        $produtoId = $request->input('produto_id');
        $qte = $request->input('qte');

        if ($itemSaleNfce->addProduto($produtoId, $qte)) {
            return response()->json([
                'message' => 'Item adicionado com sucesso!'
            ]);
        }

        return response()->json([
            'message' => 'Erro ao adicionar item.'
        ], 500);
    }
}
