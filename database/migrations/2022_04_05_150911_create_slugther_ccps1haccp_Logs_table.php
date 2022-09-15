<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugtherCcps1haccpLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slugther_ccps1haccp_logs', function (Blueprint $table) {

/*        'first_carcase_id_number',
        'date',
        'shift',
        'limit',
        'defect_description',
        'carcase_id',
        'correctuve_action_id',
        'preventive_action_id',
        'initial_time',
        'records_review_found_aceptabol',
        'pre_shipment_review',
        
        'monitor_name',
        'visualizar_name',
        'pre_shipment_name',
        'director_general_evaluation',
        'name_director',
        'time_director_aprobation',

*/
            $table->id();
            $table->integer('first_carcase_id_number');
            $table->date('date');
            $table->string('shift');
            $table->string('limit');
            $table->text('defect_description');
            $table->integer('carcase_id');
            $table->time('initial_time');
    
            $table->string('records_review_found_aceptabol');
            $table->string('pre_shipment_review');
            $table->string('monitor_name');
            $table->string('visualizar_name');
            
            $table->string('director_general_evaluation');
            $table->string('name_director');
            $table->string('time_director_aprobation');
    
                     
            $table->bigInteger('correctuve_action_id')->unsigned();
    
            $table->bigInteger('preventive_action_id')->unsigned();
          
            $table->foreign('correctuve_action_id')->references('id')->on('relapse_actions')->onDelete("cascade");
      
            $table->foreign('preventive_action_id')->references('id')->on('preventive_actions')->onDelete("cascade");

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
        Schema::dropIfExists('slugther_ccps1haccp_Logs');
    }
}
