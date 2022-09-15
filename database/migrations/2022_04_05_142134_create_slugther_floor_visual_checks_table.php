<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugtherFloorVisualChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *      'period',
     *   'qa_user_id',
      *  'date',
       * 'qualified_employee',
       * 'specific_job',
       * 'sanitary_conditions',
       * 'pass_or_fails',
       *  '',
       *  '',
       *   'reduction_comments'
     */
    public function up()
    {
        Schema::create('slugther_floor_visual_checks', function (Blueprint $table) {
            $table->id();
           
            $table->string('period');
            $table->date('date');
            $table->string('specific_job');
            $table->text('sanitary_conditions')->nullable();
            $table->boolean('pass_or_fails');
            $table->boolean('chain_speed');
            $table->boolean('two_nife');
            $table->text('reduction_comments');

     
            $table->bigInteger('qa_user_id')->unsigned();
          
            $table->foreign('qa_user_id')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('slugther_floor_visual_checks');
    }
}
