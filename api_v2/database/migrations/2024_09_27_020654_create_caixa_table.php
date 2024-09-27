<?php

// By Kochem

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
        Schema::create('caixa', function (Blueprint $table) {
            $table->id();

            $table->string('origem');

            // FK da NFCe vendida
            $table->unsignedBigInteger('cod_vendanfce');
            $table->foreign('cod_vendanfce')->references('id')->on('vendanfce')->onDelete('cascade');
            $table->string('descricao_lancamento');

            // ---------------------------


            // FK cliente
            $table->unsignedBigInteger('codcliente');;
            $table->foreign('codcliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('cliente');
            // ---------------------------

            $table->decimal('valorentrada');
            $table->decimal('valorsaida');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caixa');

    }
};
