<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toasts', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('specialty_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('text');
            $table->enum('difficulty', array('high', 'medium' , 'low'));
            $table->enum('language', array('arabe', 'french' , 'english'));
            $table->text('link');
            $table->timestamps();


            $table->foreign('specialty_id')
                ->references('id')->on('specialties')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('toasts');
    }
}
