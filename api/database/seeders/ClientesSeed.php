<?php

// By Kochem

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Clientes;

class ClientesSeed extends Seeder {
    public function run()
    {
        $clientes = [
            [
                'nome_completo' => 'Consumidor Padrão',
                'tipo_pessoa' => 1,
                'cpf' => '088.051.669-01',
                'cnpj' => null,
                'data_nascimento' => '2006-09-12',
                'tipo_cadastro' => 1
            ]
        ];
       
        foreach ($clientes as $cliente) {
            Clientes::create($cliente);

        }
    }
    
}