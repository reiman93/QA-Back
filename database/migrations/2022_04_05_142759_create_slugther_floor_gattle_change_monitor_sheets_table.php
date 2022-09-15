<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugtherFloorGattleChangeMonitorSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*        'date',
        'time',
        'state',
        'carcass_num_age',
        'equipment_cleaned_and_sterilized',
         'monitored_by'*/
    public function up()
    {
        Schema::create('slugther_floor_gattle_change_monitor_sheets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('state');

            $table->integer('carcass_num_age');
            $table->boolean('equipment_cleaned_and_sterilized');


                 
            $table->bigInteger('monitored_by')->unsigned();
          
            $table->foreign('monitored_by')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('slugther_floor_gattle_change_monitor_sheets');
    }
}
