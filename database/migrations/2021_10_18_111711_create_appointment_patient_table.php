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
            $table->id();
            $table->integer('appointment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('patient_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
