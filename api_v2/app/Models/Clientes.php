<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'Clientes';
    protected $fillable = [
        'nome_completo',
        'tipo_pessoa',
        'cpf',
        'data_nascimento',
        'tipo_cadastro'
    ];
}
