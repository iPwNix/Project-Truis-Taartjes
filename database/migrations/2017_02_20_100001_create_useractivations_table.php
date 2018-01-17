<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUseractivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useractivations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id', 10);
            $table->integer('userID')->unsigned();
            $table->foreign('userID')->references('id')->on('users');
            $table->string('token', 191);
            //$table->string('token')->index();
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
        Schema::drop('useractivations');
    }
}
