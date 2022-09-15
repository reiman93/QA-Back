<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalHandingAuditFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_handing_audit_forms', function (Blueprint $table) {
            $table->id();
            $table->string('plant_number');
            $table->string('haad_count');
            $table->string('shift');
            $table->string('prod_usage');
            $table->string('in_plant');
            $table->integer('vocalization5');
            $table->integer('vocalization3');
            $table->string('acts_abuse_observe');
            $table->string('acces_to_clean_drinking_wather');
            $table->string('holding_pens_overcrowded');
            $table->string('kept_les_75');
            $table->string('name_employed_stunning');
            $table->string('name_employed_prodding');
            $table->string('triller_condition');
            $table->string('tuck_name_number');
           
            $table->time('time_arrival');
            $table->time('time_unloading');
          
            $table->string('state_animal');
            $table->text('name');
            $table->text('comments');
            $table->string('unloading_dock');
            $table->string('willfull_acts_ofabuse');
            $table->string('sleep_fals');
            $table->string('vocalization');
            $table->string('rotating_knocking_box');

           
           
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
        Schema::dropIfExists('animal_handing_audit_forms');
    }
}
