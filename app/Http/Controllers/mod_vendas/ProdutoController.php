<?php

namespace App\Http\Controllers\mod_vendas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mod_vendas\Produto;

class ProdutoController extends Controller
{
    public function criarProduto(Request $request)
    {
        $nome_do_produto = $request->input('nome_Produto_novo');

        $produto = Produto::create([
            'nome_produto' => $nome_do_produto,
        ]);

        return response()->json([
            'success' => true,
            'nome' => $produto->nome_produto,
        ]);
    }
}
