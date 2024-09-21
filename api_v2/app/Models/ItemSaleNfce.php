<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSaleNfce extends Model
{
    use HasFactory;

    protected $table = 'item_sale_nfce';

    protected $fillable = [
        'cod_produto',
        'cadastro',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'cod_produto'); // Corrigido para belongsTo
    }

    public function saleNfce()
    {
        return $this->belongsTo(SaleNfce::class, 'item_sale_nfce_id'); // Adicionando a relação com SaleNfce
    }
}
