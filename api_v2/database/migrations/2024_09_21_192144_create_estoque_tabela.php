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
    public function up(): void
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('cod_gtin');
            $table->decimal('preco_venda', 10, 2 );
            $table->decimal('preco_custo', 10, 2 );
            $table->decimal('perc_lucro', 10, 2 );
            $table->decimal('qte');
            $table->integer('cfop');
            $table->integer('csosn');
            $table->bigInteger('ncm');
            $table->boolean('ativo')->default(true);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('estoque');

    }
};
