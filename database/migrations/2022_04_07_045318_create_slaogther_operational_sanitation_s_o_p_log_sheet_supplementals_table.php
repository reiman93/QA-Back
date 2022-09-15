<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlaogtherOperationalSanitationSOPLogSheetSupplementalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slaogther_operational_sanitation_s_o_p_log_sheet_supplementals', function (Blueprint $table) {
           /*       'user_auditor',
        'date',
        'verifyed_by',
        'decfects_description',
        'disposition_of_product',
         'restoration_sanitary_condition',
         'root_cause',
         'Further_planned_actions',*/
         $table->id();
          $table->date('date');
          $table->text('decfects_description');
          $table->string('disposition_of_product');
          $table->boolean('restoration_sanitary_condition');
          $table->string('root_cause');
          $table->string('Further_planned_actions');
          $table->string('prod_usage_kill_box');
  
    
  
                   
                            
          $table->bigInteger('verifyed_by')->unsigned();
   
          
          $table->foreign('verifyed_by')->references('id')->on('users')->onDelete("cascade");
    
     

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
        Schema::dropIfExists('slaogther_operational_sanitation_s_o_p_log_sheet_supplementals');
    }
}
