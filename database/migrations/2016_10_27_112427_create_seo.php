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
        Schema::create('seos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_old', 255)->nullable();
            $table->string('url_new', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('alt', 255)->nullable();
            $table->mediumText('span')->nullable();
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
