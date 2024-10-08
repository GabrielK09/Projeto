<?php
// By Kochem

namespace App\Http\Controllers\Api\V2\Pdv;

use App\Http\Controllers\Controller;
use App\Models\ItemVendaNfce;
use App\Models\Estoque;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        try {
            $produtos = Estoque::paginate(20);
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
            'cod_gtin' => [
                'required',
                'string',
                'max:14',
                'min:8',
                Rule::unique('estoque') // Adjust if necessary
            ],
            'preco_venda' => 'required|numeric|gt:0',
            'preco_custo' => 'required|numeric|gt:0',
            'perc_lucro' => 'required|numeric|gt:0',
            'cfop' => 'required|numeric|gt:0',
            'csosn' => 'required|numeric|gt:0',
            'ncm' => 'required|numeric|gt:0',

        ]);

        $produto = Estoque::create($validate);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'produto' => $produto

        ], 201);
    }

    public function show(string $id)
    {
        $produto = Estoque::findOrFail($id);
        return response()->json($produto);
    }

    public function update(Request $request, string $id)
    {
        $produto = Estoque::findOrFail($id);
        $produto->update($request->all());

        return response()->json([
            'message' => 'Produto alterado com sucesso!',
            'produto' => $produto
        ]);
    }

    public function inativar(string $id)
    {
        $produto = Estoque::find($id);
        $produto->ativo = false;
        $produto->save();

        return response()->json([
            'message' => 'Produto inativado com sucesso!',
        ]);
    }

    public function ativar(string $id)
    {
        $produto = Estoque::find($id);
        $produto->ativo = true;
        $produto->save();

        return response()->json([
            'message' => 'Produto ativado com sucesso!',

        ]);
        
    }
}
