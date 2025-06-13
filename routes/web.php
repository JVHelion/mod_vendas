<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mod_vendas\UsuarioController;
use App\Http\Controllers\mod_vendas\ProdutoController;

Route::get('/', function () {
    return view('/mod_vendas/home');
});

Route::group(['prefix' => 'mod_vendas'], function (){
    Route::post('criar_usuario', [UsuarioController::class, 'criarUsuario']);
    Route::post('criar_produto', [ProdutoController::class, 'criarProduto']);
});
