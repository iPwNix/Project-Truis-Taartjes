<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id', 10);
            $table->string('username', 25)->unique();
            $table->string('email', 191)->unique();
            $table->string('password', 191);

            $table->string('userIP', 191);
            
            $table->tinyInteger('activated')->default(0);
            $table->integer('profileID')->unsigned();
            $table->foreign('profileID')->references('id')->on('profiles');
            $table->integer('roleID')->unsigned();
            $table->foreign('roleID')->references('id')->on('roles');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
