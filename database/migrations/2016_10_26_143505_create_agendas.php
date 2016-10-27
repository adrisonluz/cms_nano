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
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('conteudo');
            $table->date('data_ini');
            $table->date('data_fim');
            $table->string('imagem', 255)->nullable();
            $table->string('titulo', 255)->nullable();
            $table->string('url', 255)->nullable();            
            $table->string('ativo', 45);
            $table->timestamp('lixeira')->nullable();
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
