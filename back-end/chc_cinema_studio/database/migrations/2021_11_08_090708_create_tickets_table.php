<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("row")->nullable();
            $table->string("col")->nullable();
            $table->string("user_name")->nullable();
            $table->string("user_surname")->nullable();
            $table->bigInteger("reservation_id")->unsigned()->nullable();
            $table->foreign("reservation_id")->references("id")->on("reservations");
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
        Schema::dropIfExists('tickets');
    }
}
