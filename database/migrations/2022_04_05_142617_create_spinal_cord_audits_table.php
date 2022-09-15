<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpinalCordAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
           Schema::create('spinal_cord_audits', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('period');
            $table->boolean('aceptavol_value');
            $table->boolean('unaceptavol_value');
            $table->text('comments');
            $table->boolean('inked_missplits');
                       
            $table->bigInteger('users_id')->unsigned();
          
            $table->foreign('users_id')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('spinal_cord_audits');
    }
}
