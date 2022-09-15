<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNozzleInspectionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nozzle_inspection_forms', function (Blueprint $table) {
          
            $table->id();
            $table->dateTime('date');
            $table->string('process');
            $table->integer('period');
            $table->time('time');
           
            $table->boolean('lactic_mp3');
            $table->boolean('nozzals_working');
            $table->boolean('plugged_nozzles');
            $table->boolean('propper_alications');
            $table->boolean('product_sprend_out');
     
    
                     
            $table->bigInteger('auditor')->unsigned();
   
          
            $table->foreign('auditor')->references('id')->on('users')->onDelete("cascade");
      

       /*      $table->bigInteger('users_id')->unsigned();
   
          
            $table->foreign('users_id')->references('id')->on('users')->onDelete("cascade"); */
      

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
        Schema::dropIfExists('nozzle_inspection_forms');
    }
}
