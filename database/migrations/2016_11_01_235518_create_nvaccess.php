<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNvaccess extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('nvaccess', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 45);
            $table->unsignedInteger('nivel')->nullable();
            $table->foreign('nivel')
                    ->references('id')->on('niveis')
                    ->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
