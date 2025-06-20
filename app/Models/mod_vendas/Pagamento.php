<?php

namespace App\Models\mod_vendas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'mod_vendas_pagamento';

    protected $fillable = [
        'id_pedido',
        'parcela_pagamento',
        'valor_parcela',
        'data_vencimento',
    ];

}
