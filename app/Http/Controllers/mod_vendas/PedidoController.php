<?php

namespace App\Http\Controllers\mod_vendas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function inserirPedidos(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:users,id',
            'pedidos' => 'required|array|min:1',
            'pedidos.*.produtoId' => 'required|exists:mod_vendas_produto,id',
            'pedidos.*.quantidade' => 'required|integer|min:1',
            'pedidos.*.valorUnitario' => 'required|numeric|min:0.01',
            'pedidos.*.subtotal' => 'required',
        ]);

        \DB::beginTransaction();
        try {
            $pedido = \App\Models\mod_vendas\Pedido::create([
                'id_users' => $data['cliente_id'],
            ]);

            foreach ($data['pedidos'] as $item) {
                \DB::table('mod_vendas_item_pedido')->insert([
                    'id_pedido' => $pedido->id,
                    'id_produto' => $item['produtoId'],
                    'quantidade' => $item['quantidade'],
                    'valor_unitario' => str_replace(',', '.', $item['valorUnitario']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            \DB::commit();
            return response()->json(['success' => true, 'pedido_id' => $pedido->id]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
