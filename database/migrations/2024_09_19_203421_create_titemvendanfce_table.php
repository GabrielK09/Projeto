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
        Schema::create('titemvendanfce', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigIntege('produto_id');
            $table->foreign('produto_id')->references('id')->on('tproduto')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titemvendanfce');

    }
};
