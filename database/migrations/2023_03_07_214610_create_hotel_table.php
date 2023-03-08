<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creacion de tabla hotel
        Schema::create('hotel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('nit');
            $table->integer('num_room');
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
        //En caso que exista la tabla esta se borra y vuelta y se instala
        Schema::dropIfExists('hotel');
    }
}
