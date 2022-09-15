<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopLogSheetSupplementalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sop_log_sheet_supplementals', function (Blueprint $table) {
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
        Schema::dropIfExists('sop_log_sheet_supplementals');
    }
}
