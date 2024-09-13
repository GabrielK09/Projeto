<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tprodutos extends Model
{
    protected $fillable = [
        'nome', 
        'cod_gtin', 
        'preco_venda', 
        'cfop',
        'csosn',
        'ncm',
        'qte',
        'ativo'
    
    ];

    protected static function ativo() {
        parent::ativo();

        static::addGlobalScope('ativo', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('ativo', true);
            
        });
    }
}
