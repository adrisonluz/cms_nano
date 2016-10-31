<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_onlineviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 45);
            $table->string('sessao', 255)->nullable();
            $table->string('time_end', 255)->nullable();
            $table->string('url', 255)->nullable();
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
