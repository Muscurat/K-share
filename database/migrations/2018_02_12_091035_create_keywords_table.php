<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('toast_id')->unsigned();
            $table->string('keyword');
            $table->timestamps();

            $table->foreign('toast_id')
                ->references('id')->on('toasts')
                ->onDelete('cascade');

          //  $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}
