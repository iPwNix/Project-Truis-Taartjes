<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontquotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontquotes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id', 1);
            $table->string('imageName', 75)->default('frontPhoto.jpg');
            $table->string('quote', 75);
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
        Schema::drop('frontquotes');
    }
}
