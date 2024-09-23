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
        // Verifica se a tabela já existe antes de criar
        if (!Schema::hasTable('VendaNfce')) {
            Schema::create('VendaNfce', function (Blueprint $table) {
                $table->id(); // Já cria a chave primária automaticamente
                $table->unsignedBigInteger('itemvendanfce_id');
                $table->foreign('itemvendanfce_id')->references('id')->on('ItemVendaNfce')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('VendaNfce', function (Blueprint $table) {
            $table->dropForeign(['itemvendanfce_id']); // Remove a chave estrangeira
        });

        Schema::dropIfExists('VendaNfce');
    }
};
