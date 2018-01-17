<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsotopeimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isotopeimages', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id', 2);
            $table->string('imageName', 75)->default('defaultIsotope.jpg');

            $table->integer('isoTypeOne')->unsigned();
            $table->foreign('isoTypeOne')->references('id')->on('isotopetypes');

            $table->integer('isoTypeTwo')->unsigned()->nullable();
            $table->foreign('isoTypeTwo')->references('id')->on('isotopetypes');

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
        Schema::dropIfExists('isotopeimages');
    }
}
