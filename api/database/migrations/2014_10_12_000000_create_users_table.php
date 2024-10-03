<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrations.
     *
     * Este método é responsável por criar a tabela 'usuarios' no banco de dados.
     * Ele define a estrutura da tabela, incluindo colunas e seus tipos.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como chave primária autoincrementável
            $table->string('nome'); // Cria a coluna 'nome' para armazenar o nome do usuário
            $table->string('email')->unique(); // Cria a coluna 'email' que deve ser única
            $table->timestamp('email_verificado_em')->nullable(); // Coluna para armazenar a data de verificação do e-mail (opcional)
            $table->string('senha'); // Cria a coluna 'senha' para armazenar a senha do usuário
            $table->rememberToken(); // Adiciona um token para "lembrar" o usuário (usado em autenticação)
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' para rastrear a criação e atualização
        });
    }

    /**
     * Reverte as migrations.
     *
     * Este método é responsável por excluir a tabela 'usuarios' caso a migration seja revertida.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios'); // Remove a tabela 'usuarios' do banco de dados
    }
};
