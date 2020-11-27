<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('movie_id')->unsigned();
             $table->foreign('movie_id')->references('id')->on('movies');
             $table->integer('member_id')->unsigned();
             $table->foreign('member_id')->references('id')->on('members');
             $table->date('lending_date');
             $table->integer('lateness_charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lending');
    }
}
