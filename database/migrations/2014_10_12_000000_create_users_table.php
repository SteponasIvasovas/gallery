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
            $table->increments('id');
            //prisijungimo informacija
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('admin')->default(0);
            //profilis
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('avatar')->nullable();
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();

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
