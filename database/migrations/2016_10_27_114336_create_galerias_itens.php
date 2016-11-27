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
        Schema::create('cms_galerias_itens', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('galeria_id');
			$table->foreign('galeria_id')
              ->references('id')->on('cms_galerias')
              ->onDelete('cascade');
            $table->string('titulo', 255)->nullable();
            $table->string('src', 255)->nullable()->default('noimage.png');
            $table->string('url', 255)->nullable();
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
