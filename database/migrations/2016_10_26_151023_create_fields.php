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
        Schema::create('cms_fields', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('form_id');
            $table->foreign('form_id')
              ->references('id')->on('cms_forms')
              ->onDelete('cascade');
			$table->unsignedInteger('input_id');
            $table->foreign('input_id')
              ->references('id')->on('cms_fields')
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
