<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nome');
            $table->bigInteger('cod_gtin');
            $table->decimal('preco_venda', 10, 2);
            $table->decimal('qte', 10, 2);
            $table->integer('cfop');
            $table->integer('csosn');
            $table->bigInteger('ncm');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
