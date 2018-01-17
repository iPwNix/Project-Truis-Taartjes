<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliderimages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id', 2);
            $table->string('imageName', 75)->default('defaultSlider.jpg');
            $table->string('sliderTitle', 20)->nullable();
            $table->string('sliderCaption', 25)->nullable();
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
        Schema::dropIfExists('sliderimages');
    }
}
