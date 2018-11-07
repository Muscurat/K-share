<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersToastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_toasts', function (Blueprint $table) {

            $table->increments('id')->unsigned();

            $table->integer('toast_id')->unsigned();
            $table->Integer('user_id')->unsigned();
            $table->enum('type',array('viewed','printed'));
            $table->dateTime('date');
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->text('qr');
            $table->timestamps();

            $table->foreign('toast_id')
                ->references('id')->on('toasts')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

//            $table->primary(array('toast_id', 'user_id'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_toasts');
    }
}
