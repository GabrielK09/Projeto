<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tprodutos extends Model
{
    use HasFactory;

    protected $table = 'tprodutos';
    
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

    public function titemvendanfce() {
        return $this->hasMany(Titemvendanfce::class, 'produto_id');

    }
}
