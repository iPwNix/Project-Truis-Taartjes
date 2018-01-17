<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentstatus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id', 2);
            $table->string('status', 25);
            $table->string('colorCode', 25)->default('#52d053');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentstatus');
    }
}
