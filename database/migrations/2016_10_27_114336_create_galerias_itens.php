<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriasItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias_itens', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('galeria_id');            
			$table->foreign('galeria_id')
              ->references('id')->on('galerias')
              ->onDelete('cascade');
            $table->string('titulo', 255)->nullable();
            $table->string('src', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('tipo', 45);
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
