<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tprodutos;

class Titemvendanfce extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'qte',
        'preco_unitario',
        'total'
    ];

    public function produto()
    {
        return $this->belongsTo(Tprodutos::class, 'produto_id');
        
    }
}
