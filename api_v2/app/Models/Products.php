<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

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

    /**
     * Define o relacionamento com o modelo ItemSaleNfce.
     */
    public function itemSaleNfce()
    {
        return $this->hasMany(ItemSaleNfce::class, 'cod_produto');
    }
}
