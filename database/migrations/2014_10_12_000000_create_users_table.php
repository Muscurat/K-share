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

            $table->Integer('id')->unsigned();
            $table->string('barCode');
            $table->string('photoPath');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('userName');
            $table->string('password');
            $table->string('birthday');
            $table->string('email');
            $table->enum('type' , array('student' ,'teacher' ,'external'));
            $table->string('occupation')->nullable();
            $table->string('searchField')->nullable();
            $table->string('studyLevel')->nullable();
            $table->string('domain')->nullable();
            $table->string('specialty')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->primary('id');

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
