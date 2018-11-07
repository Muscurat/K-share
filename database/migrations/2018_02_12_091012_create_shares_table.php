<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('toast_id')->unsigned();
            $table->string('social_share');
            $table->timestamps();

            $table->foreign('toast_id')
                ->references('id')->on('toasts')
                ->onDelete('cascade');

            //$table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
