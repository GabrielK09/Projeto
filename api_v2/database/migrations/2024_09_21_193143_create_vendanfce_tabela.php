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
        Schema::create('vendanfce', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_vendanfce_id');
            $table->foreign('item_vendanfce_id')->references('id')->on('item_vendanfce')->onDelete('cascade');

            $table->unsignedBigInteger('cliente_id')->default(1);
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('vendanfce', function (Blueprint $table) {
            $table->dropForeign(['item_vendanfce']); // Remover a chave estrangeira
            $table->dropForeign(['cliente_id']); // Remover a chave estrangeira
        });

        Schema::dropIfExists('vendanfce');
    }
};
