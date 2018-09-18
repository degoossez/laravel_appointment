<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsFreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments_frees', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->time('start_time');
			$table->date('end_date');  
            $table->time('end_time');                
            $table->integer('capacity');
            $table->integer('appointment_type');      
            $table->integer('user_id');            
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
        Schema::dropIfExists('appointments_frees');
    }
}
