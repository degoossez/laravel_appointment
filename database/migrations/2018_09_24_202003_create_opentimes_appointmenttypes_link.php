<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpentimesAppointmenttypesLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opentimes_has_apptypes', function (Blueprint $table) {
            //id, open_times_id, appointment_type_id
            $table->increments('id');
            $table->integer('open_times_id');
            $table->integer('appointment_type_id');
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
        Schema::dropIfExists('opentimes_has_apptypes');
    }
}
