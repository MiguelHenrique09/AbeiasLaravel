<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('idPedido');

            $table->timestamp('data_hora_pedido');
            $table->decimal('valor_total', 10, 2);
            $table->text('observacoes')->nullable();

  
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->enum('statusPedido', ['Confirmando','Preparando','Pronto']);

            $table->string('endereco', 200);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};