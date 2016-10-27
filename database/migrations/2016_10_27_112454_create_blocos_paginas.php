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
        Schema::create('blocos_paginas', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('bloco_id');
            $table->foreign('bloco_id')
              ->references('id')->on('blocos')
              ->onDelete('cascade');
			$table->unsignedInteger('pagina_id');
            $table->foreign('pagina_id')
              ->references('id')->on('paginas')
              ->onDelete('cascade');
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
