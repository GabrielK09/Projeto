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
        Schema::create('tprodutos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('cod_gtin');
            $table->decimal('preco_venda');
            $table->decimal('qte');
            $table->integer('cfop');
            $table->integer('csosn');
            $table->bigInteger('ncm');
            $table->boolean('ativo')->default(true);
            $table->timestamps();

        });

        Schema::create('titemvendanfce', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('cod_produto')->default(1);
            $table->date('cadastro');
            $table->foreign('cod_produto')->references('id')->on('tprodutos')->onDelete('cascade');    
            $table->timestamps();

        });

        Schema::create('tvendanfce', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('titemvendanfce_id');
            $table->foreign('titemvendanfce_id')->references('id')->on('titemvendanfce')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tprodutos');
        Schema::dropIfExists('titemvendanfce');
        Schema::dropIfExists('titemvendanfce');
        
    }
};
