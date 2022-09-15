<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChlorineNozzleInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
        Schema::create('chlorine_nozzle_inspections', function (Blueprint $table) {
            $table->id();
           
            $table->date('date');
            $table->string('action');
            $table->integer('period');
            $table->time('time');
            $table->string('clorine');
            $table->text('sanitary_conditions')->nullable();
            $table->text('nozzels_working_propiety')->nullable();
            $table->boolean('flugged_nozzels');
            $table->boolean('barrel_checked');
            $table->boolean('chlorine_added');
            $table->text('comments');

     
            $table->bigInteger('auditor_user_id')->unsigned();
          
            $table->foreign('auditor_user_id')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('chlorine_nozzle_inspections');
    }
}
