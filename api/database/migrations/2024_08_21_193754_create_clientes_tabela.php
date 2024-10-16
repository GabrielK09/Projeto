<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();;
            $table->date('data_nascimento');
            
            $table->integer('tipo_pessoa'); // Física ou júridica 
            $table->integer('tipo_cadastro');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');

    }
};