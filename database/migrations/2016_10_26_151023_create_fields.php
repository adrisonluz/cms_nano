<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('form_id');
            $table->foreign('form_id')
              ->references('id')->on('forms')
              ->onDelete('cascade');
			$table->unsignedInteger('input_id');
            $table->foreign('input_id')
              ->references('id')->on('fields')
              ->onDelete('cascade')->nullable();
            $table->string('nome', 255)->nullable();
            $table->string('valor', 255)->nullable();
            $table->string('placeholder', 255)->nullable();
            $table->string('classe', 255)->nullable();
            $table->string('obrigatorio', 45);
            $table->string('tipo', 45);
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
