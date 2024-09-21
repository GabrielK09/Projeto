<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tprodutos;

class CategoriaAndFornecedor extends Seeder
{
    public function run(): void
    {
        Tprodutos::create([
            'nome' => 'Produto A',
            'cod_gtin' => '1234567890123',
            'preco_venda' => 100.00,
            'cfop' => '5101',
            'csosn' => '102',
            'ncm' => '1234.56.78',
            'qte' => 10,
            'ativo' => 1,
        ]);
        
    }
}