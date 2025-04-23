<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date', 45)->nullable();
            $table->string('time', 25)->nullable();
            $table->boolean('isDone')->nullable()->default(false);
            $table->boolean('isAborted')->default(false);
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
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('trashed')->default(false);
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
};
