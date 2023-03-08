<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creacion de tabla de acomodaciones
        Schema::create('accomodation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num_bedrooms');
            $table->string('type_room');
            $table->string('accomodation');
            $table->integer('id_hotel');
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
        Schema::dropIfExists('accomodation');
    }
}
