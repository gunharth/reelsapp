<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClipReelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clip_reel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clip_id')->unsigned()->index();
            $table->integer('reel_id')->unsigned()->index();
            $table->integer('sort')->index();
            $table->timestamps();

            $table->foreign('clip_id')
                  ->references('id')
                  ->on('clips')
                  ->onDelete('cascade');

            $table->foreign('reel_id')
                  ->references('id')
                  ->on('reels')
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
        Schema::drop('clip_reel');
    }
}
