<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRandomAuditSampleTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
       'date',
        'verification_type',
        'random_time',
        'random_num',
        'randomcode'
    */
    public function up()
    {
        Schema::create('random_audit_sample_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('verification_type');
            $table->time('random_time');
            $table->time('random_num');
            $table->string('random_code');
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
        Schema::dropIfExists('random_audit_sample_times');
    }
}
