<?php

namespace App\Models\mod_vendas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'mod_vendas_produto';

    protected $fillable = [
        'nome_produto',
    ];
}
