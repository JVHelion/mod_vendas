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

    public function listarProdutos(Request $request)
    {
        $produtos = \App\Models\mod_vendas\Produto::select('id', 'nome_produto')->get();
        return response()->json($produtos);
    }

    public function buscarProdutos(Request $request)
    {
        $validated = $request->validate([
            'term' => 'nullable|string|max:100'
        ]);

        $search = $validated['term'] ?? '';

        $produtos = Produto::where('nome_produto', 'like', '%' . $search . '%')
            ->select('id', 'nome_produto as text')
            ->limit(20)
            ->get();

        return response()->json(['results' => $produtos]);
    }
}
