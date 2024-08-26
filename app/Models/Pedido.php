<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    
    // Se você não estiver usando timestamps
    public $timestamps = false;

    // Se você quiser definir quais atributos podem ser atribuídos em massa
    protected $fillable = ['item', 'descricao', 'quantia'];
}