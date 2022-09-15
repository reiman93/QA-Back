<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOperationalSanitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_operational_sanitations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->boolean('aceptable')->default(true);
            $table->dateTime('date');
            $table->text('notes')->nullable();

            $table->bigInteger('areas_id')->unsigned();

            $table->bigInteger('users_id')->unsigned();
            
            $table->bigInteger('deficiency_types_id')->unsigned()->nullable();
            $table->bigInteger('relapse_actions_id')->unsigned()->nullable();
            $table->bigInteger('janitors_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete("cascade");

            $table->foreign('areas_id')->references('id')->on('areas')->onDelete("cascade");

            $table->foreign('deficiency_types_id')->references('id')->on('deficiency_types')->onDelete("cascade");
            $table->foreign('relapse_actions_id')->references('id')->on('relapse_actions')->onDelete("cascade");
            $table->foreign('janitors_id')->references('id')->on('janitors')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_operational_sanitations');
    }
}
