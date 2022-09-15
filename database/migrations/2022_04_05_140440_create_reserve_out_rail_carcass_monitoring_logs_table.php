<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserveOutRailCarcassMonitoringLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */

     /*
             'date',
        'shift',
        'carcasse_ID_number',
        'reason',
        'time_out',
        'time_checked',
        'dropped_carcass',
        'min_45',
        'may_45',
        'zero_tolerance',
        'auditor_id_user'   
     */
    public function up()
    {
        Schema::create('reserve_out_rail_carcass_monitoring_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('date');
            $table->string('shift');
            $table->Integer('carcasse_ID_number');
            $table->string('reason');
            $table->time('time_out');
            $table->time('time_checked');
            $table->Integer('dropped_carcass');
            $table->Integer('min_45');
            $table->Integer('may_45');
            $table->Integer('zero_tolerance');
           // $table->Integer('auditor_id_user');

                             
            $table->bigInteger('auditor_id_user')->unsigned();
          
            $table->foreign('auditor_id_user')->references('id')->on('users')->onDelete("cascade");
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
        Schema::dropIfExists('reserve_out_rail_carcass_monitoring_logs');
    }
}
