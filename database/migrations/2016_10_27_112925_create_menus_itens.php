<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus_itens', function (Blueprint $table) {
            $table->increments('id');
			         $table->unsignedInteger('menu_id');
            $table->foreign('menu_id')
              ->references('id')->on('cms_menus')
              ->onDelete('cascade');
			$table->unsignedInteger('menupai_id');
            $table->foreign('menupai_id')
              ->references('id')->on('cms_menus_itens')
              ->onDelete('cascade')->nullable();
            $table->string('titulo', 255)->nullable();
            $table->string('link', 255)->nullable();
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
