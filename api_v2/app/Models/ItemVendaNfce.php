<?php

// By Kochem

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVendaNfce extends Model
{
    use HasFactory;

    protected $table = 'item_vendanfce';

    protected $fillable = [
        'cod_produto',
        'nome',

    ];

    public function produtos()
    {
        return $this->belongsTo(Produtos::class, 'cod_produto'); // Corrigido para belongsTo
    }

    public function vendaNfce()
    {
        return $this->belongsTo(VendaNfce::class, 'item_vendanfce_id'); // Adicionando a relação com SaleNfce
    }
}
