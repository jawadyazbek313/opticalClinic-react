<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_payment', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('patient_id');
            $table->integer('payment_id');
            
            $table->foreign('patient_id', 'patient_payment_ibfk_1')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_id', 'patient_payment_ibfk_2')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_payment');
    }
}
