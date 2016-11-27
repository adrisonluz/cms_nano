<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cms_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('login', 255)->nullable();

            $table->string('rg', 255)->nullable();
            $table->string('cpf', 255)->nullable();
            $table->date('nascimento');
            $table->string('telefone', 255)->nullable();
            $table->string('celular', 255)->nullable();

            $table->string('foto', 255)->nullable()->default('noimage.png');
            $table->string('endereco', 255);
            $table->string('bairro', 255);
            $table->string('cidade', 255);
            $table->string('uf', 45);
            $table->string('cep', 255)->nullable();
            $table->mediumText('observacoes')->nullable();
            $table->unsignedInteger('nivel')->nullable();
            $table->foreign('nivel')
                    ->references('id')->on('niveis')
                    ->onDelete('set null')->nullable();
            $table->string('lixeira', 45)->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id')
                    ->references('id')->on('cms_users')
                    ->onDelete('set null')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
