<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mod_vendas\UsuarioController;
use App\Http\Controllers\mod_vendas\ProdutoController;
use App\Http\Controllers\mod_vendas\PedidoController;

Route::get('/', function () {
    return view('/mod_vendas/home');
});

Route::group(['prefix' => 'mod_vendas'], function (){
    Route::post('criar_usuario', [UsuarioController::class, 'criarUsuario']);
    Route::post('criar_produto', [ProdutoController::class, 'criarProduto']);
    Route::get('listar_usuarios', [UsuarioController::class, 'listarUsuarios']);
    Route::get('listar_produtos', [ProdutoController::class, 'listarProdutos']);
    Route::get('buscar_usuarios', [UsuarioController::class, 'buscarUsuarios']);
    Route::get('buscar_produtos', [ProdutoController::class, 'buscarProdutos']);
    Route::post('adicionar_pedido', [PedidoController::class, 'inserirPedido']);
});
