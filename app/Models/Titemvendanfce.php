<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titemvendanfce extends Model
{
    use HasFactory;

    protected $table = 'titemvendanfce';

    protected $fillable = [
        'cod_produto',
        'cadastro'
        
    ];

    public function produto()
    {
        return $this->hasyMany(Tprodutos::class, 'produtos_id');
    }
}
