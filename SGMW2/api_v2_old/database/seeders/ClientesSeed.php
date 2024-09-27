<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//use App\Models\Tclientes;
use App\Models\Clientes;

class ClientesSeed extends Seeder
{
    public function run(): void
    {  
        $clientes = [
            [
                'nome_completo' => 'Pessoa 1 Teste',
                'tipo_pessoa' => 1,
                'cpf' => 12345678901,
                'data_nascimento' => '01/01/2000',
                'tipo_cadastro' => 1

            ],
            [
                'nome_completo' => 'Pessoa 2 Teste',
                'tipo_pessoa' => 0,
                'cpf' => '01987654321',
                'data_nascimento' => '02/02/2000',
                'tipo_cadastro' => 1

            ]

        ];

        foreach ($clientes as $cliente) {
            Clientes::create($cliente);

        }
    }
}