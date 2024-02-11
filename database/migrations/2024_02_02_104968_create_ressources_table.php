<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRessourcesTable extends Migration
{
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rapport_temps_reel');
            $table->unsignedBigInteger('id_rapport_temps_final');
            $table->unsignedBigInteger('id_rapport_final');
            $table->unsignedBigInteger('id_lap1');
            $table->unsignedBigInteger('id_lap2');

            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('ressources');
    }
}
