<?php

// By Kochem

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Estoque;

class ClientesSeed extends Seeder {
    public function run()
    {
       $produtos = [
            [
                'nome' => 'Café Baggio',
                'cod_gtin' => '7896003700011',
                'preco_venda' => 19.90,
                'preco_custo' => 10,
                'perc_lucro' => 100,
                'cfop' => '5102',
                'csosn' => '102',
                'ncm' => '09012100',
                'qte' => 100,
                'ativo' => true,
            ],
            [
                'nome' => 'Café 3 corações',
                'cod_gtin' => '7896003700011',
                'preco_venda' => 19.90,
                'preco_custo' => 101,
                'perc_lucro' => 100,
                'cfop' => '5102',
                'csosn' => '102',
                'ncm' => '09012100',
                'qte' => 100,
                'ativo' => true,
            ],
             
        ]; 

        foreach ($produtos as $produto) {
            Estoque::create($produto);

        };
    }
    
}