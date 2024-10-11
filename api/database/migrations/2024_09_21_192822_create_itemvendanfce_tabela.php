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
            $table->id(); // Controle
            $table->timestamps(); // Cadastro
            
            $table->unsignedBigInteger('cod_nfce'); // Controle VendaNFCe
            $table->foreign('cod_nfce')->references('id')->on('vendanfce')->onDelete('cascade');

            $table->integer('codproduto');
            $table->string('nome');
            $table->decimal('qte');
            $table->decimal('preco_unitario');
            
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('vendanfce', function (Blueprint $table) {
            $table->dropForeign(['cod_vendanfce']); 
        });

        Schema::dropIfExists('item_vendanfce');
    }
};
