<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        /*auditor*/
        /*        'date',
        'shift',
        'sex',
        'time',
        'state',
        'corrective_action'*/
        Schema::create('rest_rooms', function (Blueprint $table) {
            $table->id();
     
            $table->dateTime('date');
            $table->string('shift');
            $table->string('sex');
            $table->time('time');
    
            $table->string('state');
     
    
                     
            $table->bigInteger('auditor')->unsigned();
            $table->bigInteger('corrective_action')->unsigned();
          
            $table->foreign('auditor')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('corrective_action')->references('id')->on('relapse_actions')->onDelete("cascade");

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
        Schema::dropIfExists('rest_rooms');
    }
}
