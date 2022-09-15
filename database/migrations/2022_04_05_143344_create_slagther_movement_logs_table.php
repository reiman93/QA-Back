<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlagtherMovementLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*        'date',
        'Beginig_carcase_tag',
        'ending_carcase_tag',
        'no30',
        'dentition',
        'suppler_name',
        'lot_num',
        'carcases_grag_tag_num',
        'monitored_by'*/
        Schema::create('slaugther_movement_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('beginig_carcase_tag');
            $table->integer('ending_carcase_tag');
            $table->string('no30');
            $table->boolean('definition');
            $table->string('supplier_name');
            $table->string('lot_num');
            $table->integer('carcases_grag_tag_num');
    
       

                 
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
        Schema::dropIfExists('slagther_movement_logs');
    }
}
