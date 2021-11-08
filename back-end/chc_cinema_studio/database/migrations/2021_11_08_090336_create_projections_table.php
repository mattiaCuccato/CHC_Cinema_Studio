<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projections', function (Blueprint $table) {
            $table->id();
            $table->timestamp("date")->nullable();
            $table->bigInteger("film_id")->unsigned()->nullable();
            $table->bigInteger("room_id")->unsigned()->nullable();
            $table->foreign("film_id")->references("id")->on("films");
            $table->foreign("room_id")->references("id")->on("rooms");
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
        Schema::dropIfExists('projections');
    }
}
