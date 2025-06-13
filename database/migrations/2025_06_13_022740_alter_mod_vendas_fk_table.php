<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mod_vendas_pedido', function (Blueprint $table){
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('id_pagamento')->references('id')->on('mod_vendas_pagamento')->onDelete('cascade');
        });

        Schema::table('mod_vendas_item_pedido', function (Blueprint $table){
            $table->foreign('id_pedido')->references('id')->on('mod_vendas_pedido')->onDelete('cascade');
            $table->foreign('id_produto')->references('id')->on('mod_vendas_produto')->onDelete('cascade');
        });

        Schema::table('mod_vendas_pagamento', function (Blueprint $table){
            $table->foreign('id_pedido')->references('id')->on('mod_vendas_pedido')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_vendas_pedido', function (Blueprint $table) {
            $table->dropForeign(['id_users']);
            //$table->dropForeign(['id_pagamento']);
        });

        Schema::table('mod_vendas_item_pedido', function (Blueprint $table){
            $table->dropForeign(['id_pedido']);
            $table->dropForeign(['id_produto']);
        });

        Schema::table('mod_vendas_pagamento', function (Blueprint $table){
            $table->dropForeign(['id_pedido']);
        });
    }
};
