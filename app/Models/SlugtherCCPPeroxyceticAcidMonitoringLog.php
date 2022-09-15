<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugtherCCPPeroxyceticAcidMonitoringLog extends Model
{
    use HasFactory;

           /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_carcase_id_number', //1
        'date',//1
        'shift',//1
        'limit',
        'defect_description',//1
        'carcase_id',//1
        'correctuve_action_id',//1
        'preventive_action_id',//1
        'initial_time',//1
        'records_review_found_aceptabol',//1
        'pre_shipment_review',//1
        
        'monitor_name',//1
        'visualizar_name',//1
        'pre_shipment_name',//1
        'director_general_evaluation',//1
        'name_director',//1
        'time_director_aprobation',//1
    ];
}
