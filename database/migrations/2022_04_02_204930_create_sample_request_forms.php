<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleRequestForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_request_forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            
            $table->date('date');

            $table->bigInteger('users_id')->unsigned();
          
            $table->bigInteger('state_analisys_id')->unsigned();
          
            $table->bigInteger('analysis_types_id')->unsigned();
           
            $table->bigInteger('areas_id')->unsigned();
           
            $table->bigInteger('sample_forms_id')->unsigned();

            $table->bigInteger('laboratories_id')->unsigned();
           
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('state_analisys_id')->references('id')->on('state_analisys')->onDelete("cascade");
            $table->foreign('analysis_types_id')->references('id')->on('analysis_types')->onDelete("cascade");
            $table->foreign('areas_id')->references('id')->on('areas')->onDelete("cascade");
            $table->foreign('sample_forms_id')->references('id')->on('sample_forms')->onDelete("cascade");
            $table->foreign('laboratories_id')->references('id')->on('laboratories')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_request_forms');
    }
}
