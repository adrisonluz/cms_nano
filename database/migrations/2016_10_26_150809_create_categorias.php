<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('categoria_pai_id')->nullable();
            $table->foreign('categoria_pai_id')
              ->references('id')->on('categorias')
              ->onDelete('cascade')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->text('conteudo');
            $table->string('imagem', 255)->nullable();
            $table->string('url', 255)->nullable();  
            $table->integer('ordem');
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
