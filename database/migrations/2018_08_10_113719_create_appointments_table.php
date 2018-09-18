<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appointment_type');
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');   
			$table->time('end_time');			
            $table->string('cust_first_name');    
            $table->string('cust_last_name');      
            $table->string('phone');
            $table->string('cust_email');
            $table->string('cust_remark');
			$table->string('gender');
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
        Schema::dropIfExists('appointments');
    }
}
