<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 65)->nullable();
            $table->string('midname', 65)->nullable();
            $table->string('lastname', 65)->nullable();
            $table->string('dob', 15)->nullable();
            $table->string('insurance', 35)->nullable();
            $table->text('gender')->nullable();
            $table->text('bloodtype')->nullable();
            $table->text('diag')->nullable();
            $table->text('job')->nullable();
            $table->text('address')->nullable();
            $table->string('number', 45)->nullable();
            $table->text('maincomplaint')->nullable();
            $table->text('pathological_story')->nullable();
            $table->timestamps();
            $table->text('OD_VA')->nullable();
            $table->text('OS_VA')->nullable();
            $table->text('OD_AUTO')->nullable();
            $table->text('OS_AUTO')->nullable();
            $table->text('OD_BCVA_FAR')->nullable();
            $table->text('OS_BCVA_FAR')->nullable();
            $table->text('OD_NEAR')->nullable();
            $table->text('OS_NEAR')->nullable();
            $table->text('OD_AUTO_AFTER_CYCLO')->nullable();
            $table->text('OS_AUTO_AFTER_CYCLO')->nullable();
            $table->text('OD_BUT')->nullable();
            $table->text('OS_BUT')->nullable();
            $table->text('OD_IOP')->nullable();
            $table->text('OS_IOP')->nullable();
            $table->text('OD_LIDS')->nullable();
            $table->text('OS_LIDS')->nullable();
            $table->text('OD_CORNEA')->nullable();
            $table->text('OS_CORNEA')->nullable();
            $table->text('OD_CONJUNCTIVA')->nullable();
            $table->text('OS_CONJUNCTIVA')->nullable();
            $table->text('OD_IRIS')->nullable();
            $table->text('OS_IRIS')->nullable();
            $table->text('OD_AC')->nullable();
            $table->text('OS_AC')->nullable();
            $table->text('OD_LENS')->nullable();
            $table->text('OS_LENS')->nullable();
            $table->text('OD_VITREOUS')->nullable();
            $table->text('OS_VITREOUS')->nullable();
            $table->text('OD_CD')->nullable();
            $table->text('OS_CD')->nullable();
            $table->text('OD_FUNDUS')->nullable();
            $table->text('OS_FUNDUS')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
