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
        Schema::create('cms_categorias', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('categoria_pai_id')->nullable();
            $table->foreign('categoria_pai_id')
              ->references('id')->on('cms_categorias')
              ->onDelete('cascade')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->text('conteudo');
            $table->string('imagem', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->integer('ordem');
            $table->string('ativo', 45);
            $table->string('lixeira', 45)->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id')
              ->references('id')->on('cms_users')
              ->onDelete('no action')->nullable();
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
