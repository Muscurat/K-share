<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('user_toast_id')->unsigned();
            $table->string('os_version');
            $table->string('api_version');
            $table->string('device');
            $table->string('model');
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
        Schema::dropIfExists('devices');
    }
}
