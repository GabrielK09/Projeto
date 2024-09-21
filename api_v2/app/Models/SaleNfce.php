<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleNfce extends Model
{
    use HasFactory;

    protected $table = 'sale_nfce';

    protected $fillable = [
        'item_sale_nfce_id',
    ];

    /**
     * Define o relacionamento com o modelo ItemSaleNfce.
     */
    public function itemSaleNfce()
    {
        return $this->hasMany(ItemSaleNfce::class, 'item_sale_nfce_id');
    }
}
