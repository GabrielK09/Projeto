<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    
    // Se você não estiver usando timestamps
    public $timestamps = false;

    // Se você quiser definir quais atributos podem ser atribuídos em massa
    protected $fillable = ['name', 'telefone', 'cpf', 'cnpj'];
}
