<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaNfce extends Model
{
    use HasFactory;

    protected $table = 'vendanfce';

    protected $fillable = [
        'cod_cliente',
        'produto',
        'valor_produto'
        
    ];

    /**
     * Define o relacionamento com o modelo ItemSaleNfce.
     */
    public function itemVendaNfce()
    {
        //return $this->hasMany(ItemVendaNfce::class, 'cod_cliente');
    }
}
