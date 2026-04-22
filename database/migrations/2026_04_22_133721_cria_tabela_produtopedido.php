<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produto_pedido', function (Blueprint $table) {

            $table->foreignId('pedido_idPedido')
                  ->constrained('pedido', 'idPedido')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreignId('produto_idProduto')
                  ->constrained('produto', 'idProduto')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto_pedido');
    }
};