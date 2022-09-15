<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlaugtherOperationalSanitationSOPLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slaugther_operational_sanitation_s_o_p_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('inform_type');
            $table->integer('periodo');
            $table->time('time');
            $table->integer('day_hours');
            $table->string('status');
     
    
                     
            $table->bigInteger('verifyed_by')->unsigned();
            $table->bigInteger('corrective_action')->unsigned();
            $table->bigInteger('preventive_action')->unsigned();
          
            $table->foreign('verifyed_by')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('corrective_action')->references('id')->on('relapse_actions')->onDelete("cascade");
            $table->foreign('preventive_action')->references('id')->on('preventive_actions')->onDelete("cascade");

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
        Schema::dropIfExists('slaugther_operational_sanitation_s_o_p_logs');
    }
}
