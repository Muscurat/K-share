<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScansTable extends Migration
{

    public function up()
    {

        Schema::create('scans', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('user_toast_id')->unsigned();
            $table->dateTime('date');
            $table->timestamps();

            $table->foreign('user_toast_id')
                ->references('id')->on('users_toasts')
                ->onDelete('cascade');


        });


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */


    public function down()
    {
        Schema::dropIfExists('scans');
    }
}
