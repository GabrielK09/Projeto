<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrations.
     *
     * Este método é responsável por criar a tabela 'users' no banco de dados.
     * Ele define a estrutura da tabela, incluindo colunas e seus tipos.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como chave primária autoincrementável
            $table->string('name'); // Cria a coluna 'name' para armazenar o nome do usuário
            $table->string('email')->unique(); // Cria a coluna 'email' que deve ser única
            $table->timestamp('email_verified_at')->nullable(); // Coluna para armazenar a data de verificação do e-mail (opcional)
            $table->string('password'); // Cria a coluna 'password' para armazenar a senha do usuário
            $table->rememberToken(); // Adiciona um token para "lembrar" o usuário (usado em autenticação)
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' para rastrear a criação e atualização
        });
    }

    /**
     * Reverte as migrations.
     *
     * Este método é responsável por excluir a tabela 'users' caso a migration seja revertida.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users'); // Remove a tabela 'users' do banco de dados
    }
};
