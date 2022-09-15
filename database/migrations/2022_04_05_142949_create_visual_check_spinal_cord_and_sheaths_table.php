<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisualCheckSpinalCordAndSheathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        'carcase',
        '',
        'slaugther_cooler_supy',
        'qa_notified',
        'qa_id'
         */
        Schema::create('visual_check_spinal_cord_and_sheaths', function (Blueprint $table) {
            $table->id();
            $table->integer('carcase');
            $table->boolean('removed');
            $table->boolean('slaugther_cooler_supy');
            $table->boolean('qa_notified');
       

                 
            $table->bigInteger('qa_id')->unsigned();
          
            $table->foreign('qa_id')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('visual_check_spinal_cord_and_sheaths');
    }
}
