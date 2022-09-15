<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKillFloorPreOpSanitationSwabsTable extends Migration
{
    /**
     * Run the migrations.
     *         'audited_by',

     *
     * @return void
     */
    public function up()
    {
        Schema::create('kill_floor_pre_op_sanitation_swabs', function (Blueprint $table) {
            $table->id();
            $table->date('date');

            $table->string('reviewed_by');
            $table->string('sanitzer_titration');
            $table->boolean('aceptable')->default(true);
            $table->string('sanitzer_typ');
            $table->time('qa_start_time') ;
            $table->time('usda_start_time') ;    
            $table->time('floor_release_time') ;       
            $table->time('down_time') ;
            $table->text('notes')->nullable();

            $table->bigInteger('area')->unsigned();
            $table->foreign('area')->references('id')->on('areas')->onDelete("cascade");
           

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
        Schema::dropIfExists('kill_floor_pre_op_sanitation_swabs');
    }
}
