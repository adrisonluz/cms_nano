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
        Schema::create('cms_posts', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')
              ->references('id')->on('cms_categorias')
              ->onDelete('set null')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->text('conteudo');
            $table->string('imagem', 255)->nullable();
            $table->date('data');
            $table->string('url', 255)->nullable();
            $table->string('destaque', 45);
            $table->integer('ordem');
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
