<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugtherCCPS3LacticAcidMonitoringLog extends Model
{
    use HasFactory;
    protected $table = 'slugther_lactic_acids'; 
               /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_carcase_id_number',//3
        'date',//3
        'shift',//3

        'limit',

        'defect_description',//3
        'carcase_id',//3
        'correctuve_action_id',//3
        'preventive_action_id',//3
        'initial_time',//3
        'records_review_found_aceptabol',//3
        'pre_shipment_review',
        
        'monitor_name',//3
        'visualizar_name',//3
        'pre_shipment_name',//3
        'director_general_evaluation',//3
        'name_director',//3
        'time_director_aprobation',//3
        'users_id'
    ];

        /**
     * Get the User that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
