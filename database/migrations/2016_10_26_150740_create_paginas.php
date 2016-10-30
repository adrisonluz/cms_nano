<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paginas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 255)->nullable();
            $table->text('conteudo');
            $table->mediumText('resumo');
            $table->string('imagem', 255)->nullable();
            $table->date('data');
            $table->string('url', 255)->nullable();
            $table->string('ativo', 45);
            $table->string('lixeira', 45)->nullable();
            $table->integer('agent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
