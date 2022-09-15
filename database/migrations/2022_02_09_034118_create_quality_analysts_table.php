<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAnalystsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_analysts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->string('name');
            $table->string('lastname');
            $table->string('phone');
            $table->string('user');
            $table->string('password');
            $table->string('email');
            
            $table->bigInteger('departments_id')->unsigned();
            $table->timestamps();
            $table->foreign('departments_id')->references('id')->on('departments')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_analysts');
    }
}
