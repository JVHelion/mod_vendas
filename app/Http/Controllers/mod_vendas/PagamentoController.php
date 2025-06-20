<?php

namespace App\Http\Controllers\mod_vendas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function inserirPagamentos (Request $request) {
        $data = $request->validate([
            'pagamentos' => 'required|array|min:1',
            'pagamentos.*.id_pedido' => 'required|exists:mod_vendas_pedido,id',
            'pagamentos.*.qtd' => 'required|integer|min:1',
            'pagamentos.*.valor' => 'required|numeric|min:0.01',
        ]);

        \DB::beginTransaction();
        try {
            $parcelaNum = 1;
            foreach ($data['pagamentos'] as $pagamento) {
                for ($i = 0; $i < $pagamento['qtd']; $i++) {
                    \App\Models\mod_vendas\Pagamento::create(
                        [
                            'id_pedido' => $pagamento['id_pedido'],
                            'parcela_pagamento' => $parcelaNum++,
                            'valor_parcela' => (int) round(floatval(str_replace(',', '.', $pagamento['valor'])) * 100),
                            'data_vencimento' => now()->addMonths($i),
                        ]
                        );
                }
            }
            \DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
