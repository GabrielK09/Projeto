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
        if (!Schema::hasTable('ItemVendaNfce')) {
            Schema::create('ItemVendaNfce', function (Blueprint $table) {
                $table->id(); // Cria uma coluna BIGINT unsigned como chave primária
                $table->unsignedBigInteger('cod_produto'); // Certifique-se de que o tipo de dado é compatível com a tabela Produtos
                $table->foreign('cod_produto')->references('id')->on('Produtos')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::table('ItemVendaNfce', function (Blueprint $table) {
            $table->dropForeign(['cod_produto']); // Remove a chave estrangeira
        });

        Schema::dropIfExists('ItemVendaNfce');
    }
};
