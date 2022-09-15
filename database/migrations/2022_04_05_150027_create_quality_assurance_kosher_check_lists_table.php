<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityAssuranceKosherCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*       'date',
        'monitor_user_id',
        'rinsed_nife_between_carcase',
        'human_handing_procedure',
        'butt_push_been_backed',
        'Cut_has_been_sufficient',
        'Comments',
        'during_kosher_brisket',
        'neck_area_is_bane',
        'mark_on_sharks',
        'brisket_belly',
        'prior_to_any',
        'effectivenss_of_cut_kosher'*/
        Schema::create('quality_assurance_kosher_check_lists', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->boolean('informrinsed_nife_between_carcase_type');
            $table->boolean('human_handing_procedure');
            $table->boolean('butt_push_been_backed');
            $table->boolean('cut_has_been_sufficient');
            $table->text('comments');
            $table->boolean('during_kosher_brisket');
            $table->boolean('neck_area_is_bane');
            $table->boolean('effectivenss_of_cut_kosher');
                  
            $table->bigInteger('monitor_user_id')->unsigned();

            $table->foreign('monitor_user_id')->references('id')->on('users')->onDelete("cascade");

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
        Schema::dropIfExists('quality_assurance_kosher_check_lists');
    }
}
