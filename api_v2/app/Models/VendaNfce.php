<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaNfce extends Model
{
    use HasFactory;

    protected $table = 'VendaNfce';

    protected $fillable = [
        'ItemVendaNfce_id',
    ];

    /**
     * Define o relacionamento com o modelo ItemSaleNfce.
     */
    public function ItemVendaNfce()
    {
        return $this->hasMany(ItemVendaNfce::class, 'ItemVendaNfce_id');
    }
}
