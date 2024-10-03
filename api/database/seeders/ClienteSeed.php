<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Clientes;

class ClienteSeed extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nome_completo' => 'Teste',
                'tipo_pessoa' => 1,
                'tipo_cadastro' => 1,
                'data_nascimento' => '01/01/2000',
                'cpf' => '123.4567.890-10'

            ]
        ];

        foreach ($clientes as $cliente) {
            Clientes::create($cliente);

        }
    }
}
