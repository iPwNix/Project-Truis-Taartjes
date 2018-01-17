<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baksels', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id', 10);
            $table->string('title', 75);
            $table->text('description');
            $table->string('timeSpend', 25)->nullable();

            $table->integer('bakPhotosID')->unsigned();
            $table->foreign('bakPhotosID')->references('id')->on('bakselPhotos');

            $table->integer('bakTypeID')->unsigned();
            $table->foreign('bakTypeID')->references('id')->on('baktypes');

            $table->integer('bakStatusID')->unsigned();
            $table->foreign('bakStatusID')->references('id')->on('bakstatus');

            $table->integer('commentStatusID')->unsigned();
            $table->foreign('commentStatusID')->references('id')->on('commentstatus');

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
        Schema::dropIfExists('baksels');
    }
}
