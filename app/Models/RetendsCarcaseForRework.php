<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetendsCarcaseForRework extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usda_retaind',
        'spinal_cords',
        'qa_retained',
        'other',
        'date',
        'total_head_retained',
        'location_inbox',
        'rails',
        'approx_time',
        'qa_id',
        'usda_inspector',
        'area_id',
        'tipe_contamination_id',
        'source',
        'corrective_action_id',
        'route_cause',
        'preventive_action_id',
    ];
}
