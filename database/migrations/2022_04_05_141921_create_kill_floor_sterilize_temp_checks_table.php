<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKillFloorSterilizeTempChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kill_floor_sterilize_temp_checks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('priot_tostar_up');
            $table->integer('temperature');
            $table->string('period');
          //$table->integer('temperature1');
          // $table->time('period2');
           //$table->integer('temperature2');
          //$table->time('period3');
         // $table->integer('temperature3');
            $table->text('notes')->nullable();
            $table->string('locations');

      
            $table->bigInteger('auditor_id')->unsigned();
            $table->bigInteger('relapse_actions_id')->unsigned()->nullable();
          
            $table->foreign('auditor_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('relapse_actions_id')->references('id')->on('relapse_actions')->onDelete("cascade");
           
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
        Schema::dropIfExists('kill_floor_sterilize_temp_checks');
    }
}
