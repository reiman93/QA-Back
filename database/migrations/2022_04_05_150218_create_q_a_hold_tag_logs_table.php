<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQAHoldTagLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*        'date',
        'shift',
        'initials',
        'tag',
        'reason_tag_was_written',
        'product_disposition',
        'tag_pulled',*/
        Schema::create('q_a_hold_tag_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('shift');
            $table->string('initials');
            $table->integer('tag');
            $table->text('reason_tag_was_written');
            $table->string('product_disposition');
            $table->string('tag_pulled');

            $table->bigInteger('verifyed_by')->unsigned();
            $table->foreign('verifyed_by')->references('id')->on('users')->onDelete("cascade");
            
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
        Schema::dropIfExists('q_a_hold_tag_logs');
    }
}
