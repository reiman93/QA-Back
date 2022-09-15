<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalHandingAuditForm extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plant_number',
        'users_id', //auditor_id_user
        'haad_count',
        'name',
        'shift',
        'wather',
        'state_animal',
        'prod_usage',
        'in_plant',
        'vocalization5',
        'vocalization3',
        'acts_abuse_observe',
        'acces_to_clean_drinking_wather',
        'holding_pens_overcrowded',
        'kept_les_75',
        'name_employed_stunning',
        'name_employed_prodding',
        'triller_condition',
        'tuck_name_number',
         'time_arrival',
         'time_unloading',
         'comments',
         'corrective_actions_id',
         'unloading_dock',
         'willfull_acts_ofabuse',
         'sleep_fals',
         'vocalization',
         'rotating_knocking_box'
    ];
}
