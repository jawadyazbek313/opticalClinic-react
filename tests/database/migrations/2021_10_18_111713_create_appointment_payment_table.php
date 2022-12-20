<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_payment', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('appointment_id');
            $table->integer('payment_id');
            
            $table->foreign('payment_id', 'appointment_payment_ibfk_1')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('appointment_id', 'appointment_payment_ibfk_2')->references('id')->on('appointments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_payment');
    }
}
