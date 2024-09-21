<?php

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
        Schema::create('item_sale_nfce', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('cod_produto')->default(1);
            $table->foreign('cod_produto')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('item_sale_nfce', function (Blueprint $table) {
            $table->dropForeign(['cod_produto']); // Remover a chave estrangeira
        });

        Schema::dropIfExists('item_sale_nfce');
    }
};
