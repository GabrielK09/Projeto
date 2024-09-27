<?php

// By Kochem

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
            $table->foreign('cod_produto')->references('id')->on('estoque')->onDelete('cascade');

            // $table->unsignedBigInteger('cod_vendanfce');
            // $table->foreign('cod_vendanfce')->references('id')->on('vendanfce')->onDelete('cascade');

            $table->string('nome');
            $table->decimal('qte');
            $table->decimal('total');
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
