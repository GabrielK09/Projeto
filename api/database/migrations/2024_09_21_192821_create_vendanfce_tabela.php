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
        Schema::create('vendanfce', function (Blueprint $table) {
            $table->id();
                        
            $table->unsignedBigInteger('cod_cliente');
            $table->foreign('cod_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('cliente');
            $table->decimal('valor_produto');
            $table->timestamps();

        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('vendanfce', function (Blueprint $table) {
            $table->dropForeign(['cod_cliente']);
            
        });

        Schema::dropIfExists('vendanfce');

    }
};
