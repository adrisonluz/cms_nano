<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo', 45);
			$table->unsignedInteger('pagina_id')->nullable();
            $table->foreign('pagina_id')
              ->references('id')->on('cms_paginas')
              ->onDelete('no action')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->mediumText('conteudo');
            $table->string('imagem', 255)->nullable()->default('noimage.png');
            $table->string('video', 255)->nullable();
            $table->date('data_ini');
            $table->date('data_fim');
            $table->string('link', 255)->nullable();
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
