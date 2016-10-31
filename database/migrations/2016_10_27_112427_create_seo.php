<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_seos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_old', 255)->nullable();
            $table->string('url_new', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('alt', 255)->nullable();
            $table->mediumText('span')->nullable();
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
