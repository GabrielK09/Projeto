<?php

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
        Schema::create('tpessoas', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_pessoa');
            $table->string('cfp');
            $table->string('nome_completo');
            $table->string('data_nascimento');

            $table->integer('tipo_cadastro');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tpessoas');
    }
};
