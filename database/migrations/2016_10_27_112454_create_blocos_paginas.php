<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocosPaginas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_blocos_paginas', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('bloco_id');
            $table->foreign('bloco_id')
              ->references('id')->on('cms_blocos')
              ->onDelete('cascade');
			$table->unsignedInteger('pagina_id');
            $table->foreign('pagina_id')
              ->references('id')->on('cms_paginas')
              ->onDelete('cascade');
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
