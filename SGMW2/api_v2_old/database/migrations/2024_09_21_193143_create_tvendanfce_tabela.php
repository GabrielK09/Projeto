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
        Schema::create('tvendanfce', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('titem_vendanfce_id')->default(1);
            $table->foreign('titem_vendanfce_id')->references('id')->on('titem_vendanfce')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('tvendanfce', function (Blueprint $table) {
            $table->dropForeign(['titem_vendanfce']); // Remover a chave estrangeira
        });

        Schema::dropIfExists('tvendanfce');
    }
};
