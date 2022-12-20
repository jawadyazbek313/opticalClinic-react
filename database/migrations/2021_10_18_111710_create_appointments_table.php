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
            $table->id();
            $table->string('date', 45)->nullable();
            $table->string('time', 25)->nullable();
            $table->boolean('isDone')->nullable()->default(0);
            $table->boolean('isAborted')->default(0);
            $table->text('notes')->nullable();
            $table->text('dist_r_sphere')->nullable();
            $table->text('dist_l_sphere')->nullable();
            $table->text('dist_r_cylinder')->nullable();
            $table->text('dist_l_cylinder')->nullable();
            $table->text('dist_r_axis')->nullable();
            $table->text('dist_l_axis')->nullable();
            $table->text('pddist')->nullable();
            $table->text('near_r_sphere')->nullable();
            $table->text('near_l_sphere')->nullable();
            $table->text('near_r_cylinder')->nullable();
            $table->text('near_l_cylinder')->nullable();
            $table->text('near_r_axis')->nullable();
            $table->text('near_l_axis')->nullable();
            $table->text('pdnear')->nullable();
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('trashed')->default(0);
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
