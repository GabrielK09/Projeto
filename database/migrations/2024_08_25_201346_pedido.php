<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function(Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('preview');
            $table->longText('descricao');
            $table->string('status');
            $table->string('modelo');
            $table->string('tecnico');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido');

    }
};
