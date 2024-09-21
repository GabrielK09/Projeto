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
        Schema::create('sale_nfce', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('item_sale_nfce_id');
            $table->foreign('item_sale_nfce_id')->references('id')->on('item_sale_nfce')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('sale_nfce', function (Blueprint $table) {
            $table->dropForeign(['item_sale_nfce']); // Remover a chave estrangeira
        });

        Schema::dropIfExists('sale_nfce');
    }
};
