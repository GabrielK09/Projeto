<?php

// By Kochem

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;

    protected $table = 'caixa';

    protected $fillable = [
        'origem',
        'cod_cliente',
        'cod_vendanfce',
        'descricao_lancamento',
        'cliente',
        'valorentrada',
        'valorsaida'
        
    ];
    
}
