<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {

            $table->increments('id');

            $table->Integer('id_recommender')->unsigned();
            $table->Integer('id_recommended')->unsigned();
            $table->Integer('toast_id')->unsigned();
            $table->text('comment');

            $table->timestamps();

            $table->foreign('id_recommender')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('id_recommended')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('toast_id')
                ->references('id')->on('toasts')
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
        Schema::dropIfExists('recommendations');
    }
}
