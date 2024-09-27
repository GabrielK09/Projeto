<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $table = 'produtos';

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
    public function itemVendaNfce()
    {
        return $this->hasMany(ItemVendaNfce::class, 'cod_produto');
    }
}
