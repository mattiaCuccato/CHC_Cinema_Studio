<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director_film', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("film_id")->unsigned()->nullable();
            $table->bigInteger("director_id")->unsigned()->nullable();
            $table->foreign("film_id")->references("id")->on("films");
            $table->foreign("director_id")->references("id")->on("directors");
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
        Schema::dropIfExists('director_film');
    }
}
