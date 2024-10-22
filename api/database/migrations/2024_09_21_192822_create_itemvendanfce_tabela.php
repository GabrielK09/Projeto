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
            
            $table->unsignedBigInteger('vendanfce_id')->nullable();
            $table->foreign('vendanfce_id')->references('id')->on('vendanfce')->onDelete('cascade');
            
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
        Schema::table('item_vendanfce', function (Blueprint $table) {
            $table->dropForeign(['vendanfce_id']); 
        });

        Schema::dropIfExists('item_vendanfce');
    }
};
