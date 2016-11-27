<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('conteudo');
            $table->string('data_ini', 50);
            $table->string('data_fim', 50);
            $table->string('imagem', 255)->nullable()->default('noimage.png');
            $table->string('titulo', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('ativo', 45);
            $table->string('lixeira', 45)->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id')
              ->references('id')->on('cms_users')
              ->onDelete('set null')->nullable();
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
