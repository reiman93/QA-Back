<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugtherCcps1haccpLog extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_carcase_id_number', //2
        'date',//2
        'shift',//2
        
        'limit',
       
        'defect_description',//2
        'carcase_id',//2
        'correctuve_action_id',//2
        'preventive_action_id',//2
        'initial_time',//2
        'records_review_found_aceptabol',//2
        'pre_shipment_review',//2
        
        'monitor_name',//2
        'visualizar_name',//2
        'pre_shipment_name',//2
        'director_general_evaluation',//2
        'name_director',//2
        'time_director_aprobation',//2
    ];
}
