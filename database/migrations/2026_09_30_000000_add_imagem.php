<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('produto', function (Blueprint $table) {
        $table->string('imagem_url')->nullable()->after('nome');
    });
}

    public function down(): void
    {
        Schema::table('produto', function (Blueprint $table) {
            $table->dropColumn('imagem_url');
        });
    }
};
