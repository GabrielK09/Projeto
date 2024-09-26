<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';

    protected $fillable = [
        'nome',
        'cod_gtin',
        'preco_venda',
        'preco_custo',
        'perc_lucro',
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
