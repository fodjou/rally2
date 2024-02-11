<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->float('start_point');
            $table->float('end_point');
            $table->time('start_time');
            $table->time('end_time');
            $table->float('starting_kilometer');
            $table->float('ending_kilometer');
            $table->unsignedBigInteger('id_vehicule');

            $table->timestamps();

            $table->foreign('id_vehicule')->references('id')->on('coureurs');

        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
