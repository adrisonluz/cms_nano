<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalerias extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cms_galerias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pagina_id');
            $table->foreign('pagina_id')
                    ->references('id')->on('cms_paginas')
                    ->onDelete('no action')->nullable();
            $table->unsignedInteger('post_id');
            $table->foreign('post_id')
                    ->references('id')->on('cms_posts')
                    ->onDelete('no action')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->string('imagem', 255)->nullable();
            $table->string('tipo', 45);
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
    public function down() {
        //
    }

}
