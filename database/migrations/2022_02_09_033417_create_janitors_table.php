<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJanitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('janitors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->string('name');
            $table->string('lastname');
            $table->string('phone');

            $table->bigInteger('turn_types_id')->unsigned();
            $table->bigInteger('cleaning_companies_id')->unsigned();
            
            $table->timestamps();

            $table->foreign('turn_types_id')->references('id')->on('turn_types')->onDelete("cascade");
            $table->foreign('cleaning_companies_id')->references('id')->on('cleaning_companies')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('janitors');
    }
}
