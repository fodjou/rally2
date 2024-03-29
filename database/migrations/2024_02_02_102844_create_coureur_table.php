<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoureurTable extends Migration
{
    public function up()
    {
        Schema::create('coureurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_conducteur', 255)->unique();
            $table->string('marque', 255)->nullable();
            $table->string('matricule', 30)->nullable();
            $table->string('image')->nullable();
            $table->string('sponsors', 255)->nullable();
            $table->string('logo-A')->nullable();
            $table->string('wialon_driver_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coureurs');
    }
}
