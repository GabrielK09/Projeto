<?php

// By Kochem

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = [
        'nome_completo',
        'tipo_pessoa',
        'cpf',
        'cnpj',
        'data_nascimento',
        'tipo_cadastro'
    ];
}