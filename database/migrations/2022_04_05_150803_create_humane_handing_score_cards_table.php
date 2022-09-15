<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumaneHandingScoreCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('humane_handing_score_cards', function (Blueprint $table) {
           /*'week_ending_date',
        'auditor',
        'revised_by',
        'vocalization_pans',
        'vocalization_kill_box',
        'kill_box_cut_time',
        'prod_usage_pens',
        'prod_usage_serpentine',
        'prod_usage_kill_box',
        'zero_tolerance',
        'auditor_id_user',
        'vocalzation_porcent',
        'prod_porcent',
        'captive_bolt_porcent',
        'insensibility_porcent',
        'robbi_cut',
           */
          $table->id();
          $table->date('week_ending_date');
          $table->string('vocalization_pans');
          $table->string('vocalization_kill_box');
          $table->string('kill_box_cut_time');
          $table->string('prod_usage_pens');
          $table->string('prod_usage_serpentine');
          $table->string('prod_usage_kill_box');
  
          $table->boolean('zero_tolerance');
          $table->double('vocalzation_porcent');
          $table->double('prod_porcent');
          $table->double('captive_bolt_porcent');
          
          $table->double('insensibility_porcent');
          $table->string('robbi_cut');
       
  
                   
                            
          $table->bigInteger('auditor')->unsigned();
   
          
          $table->foreign('auditor')->references('id')->on('users')->onDelete("cascade");
    
          $table->bigInteger('revised_by')->unsigned();
   
          
          $table->foreign('revised_by')->references('id')->on('users')->onDelete("cascade");
    


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
        Schema::dropIfExists('humane_handing_score_cards');
    }
}
