<?php

namespace App\Models\mod_vendas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;
    
    protected $table = 'mod_vendas_pedido';
    
    protected $fillable = [
        'id_users',
    ];
}
