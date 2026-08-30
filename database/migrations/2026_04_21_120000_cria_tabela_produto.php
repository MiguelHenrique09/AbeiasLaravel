<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id('idProduto');
            $table->string('nome_produto', 100);
            $table->text('descricao');
            $table->decimal('preco_atual', 10, 2);
            $table->enum('tipo_produto', ['Bebida', 'Lanche', 'Porção']);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};