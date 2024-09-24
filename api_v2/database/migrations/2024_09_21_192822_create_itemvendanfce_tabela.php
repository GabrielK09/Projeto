<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        Schema::create('item_vendanfce', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cod_produto')->default(1);
            $table->foreign('cod_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('item_vendanfce', function (Blueprint $table) {
            $table->dropForeign(['cod_produto']); // Remover a chave estrangeira
        });

        Schema::dropIfExists('item_vendanfce');
    }
};
