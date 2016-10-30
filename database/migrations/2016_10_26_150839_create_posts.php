<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')
              ->references('id')->on('categorias')
              ->onDelete('cascade');
            $table->string('titulo', 255)->nullable();
            $table->text('conteudo');
            $table->string('imagem', 255)->nullable();
            $table->date('data');
            $table->string('url', 255)->nullable();
            $table->string('destaque', 45);
            $table->integer('ordem');
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
