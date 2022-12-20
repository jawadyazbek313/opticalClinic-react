<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_patient', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('appointment_id');
            $table->integer('patient_id');
            
            $table->foreign('patient_id', 'appointment_patient_ibfk_1')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('appointment_id', 'appointment_patient_ibfk_2')->references('id')->on('appointments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_patient');
    }
}
