<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_specialties', function (Blueprint $table) {


            $table->integer('specialty_id')->unsigned();
            $table->Integer('user_id')->unsigned();

            $table->float('level');

            $table->timestamps();

            $table->foreign('specialty_id')
                ->references('id')->on('specialties')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->primary(array('specialty_id', 'user_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_specialties');
    }
}
