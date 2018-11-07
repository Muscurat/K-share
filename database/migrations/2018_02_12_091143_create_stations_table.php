<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('user_toast_id')->unsigned();
            $table->string('name');
            $table->double('laltitude')->nullable();
            $table->double('longitude')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('user_toast_id')
                ->references('id')->on('users_toasts')
                ->onDelete('cascade');

           // $table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
