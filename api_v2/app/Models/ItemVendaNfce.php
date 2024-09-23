<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVendaNfce extends Model
{
    use HasFactory;

    protected $table = 'ItemVendaNfce';

    protected $fillable = [
        'cod_produto',
        'cadastro',
    ];

    public function Produtos()
    {
        return $this->belongsTo(Produtos::class, 'cod_produto'); // Corrigido para belongsTo
    }

    public function VendaNfce()
    {
        return $this->belongsTo(VendaNfce::class, 'ItemVendaNfce_id'); // Adicionando a relação com SaleNfce
    }
}
