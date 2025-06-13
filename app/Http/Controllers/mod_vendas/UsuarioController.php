<?php

namespace App\Http\Controllers\mod_vendas;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function criarUsuario(Request $request)
    {
        $nome = $request->input('nome_usuario_novo');
        $cpf = $request->input('cpf_usuario_novo');

        $user = new User();
        $user->name = $nome;
        $user->mod_vendas_cpf = $cpf;
        $user->save();

        return response()->json([
            'success' => true,
            'nome' => $nome,
            'cpf' => $cpf
        ]);
    }

    public function listarUsuarios()
    {
        $usuarios = \App\Models\User::select('id', 'name')->get();
        return response()->json($usuarios);
    }
}
