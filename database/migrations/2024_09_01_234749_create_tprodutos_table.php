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
            $table->increments('id');
            $table->string('nome');
            $table->bigInteger('cod_gtin');
            $table->decimal('preco_venda');
            $table->decimal('qte');
            $table->integer('cfop');
            $table->integer('csosn');
            $table->bigInteger('ncm');
            $table->boolean('ativo')->default(true);

            $table->
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tprodutos');
    }
};
