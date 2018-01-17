<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakselphotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('bakselphotos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id', 10);
            
            $table->string('photoOne', 75)->default('defaultCake.jpg');
            $table->string('photoTwo', 75)->nullable();
            $table->string('photoThree', 75)->nullable();
            $table->string('photoFour', 75)->nullable();

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
        Schema::dropIfExists('bakselphotos');
    }
}
