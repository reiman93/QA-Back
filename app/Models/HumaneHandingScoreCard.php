<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumaneHandingScoreCard extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'week_ending_date',
        'auditor',
        'revised_by',
        'vocalization_pans',
        'vocalization_kill_box',
        'kill_box_cut_time',
        'prod_usage_pens',
        'prod_usage_serpentine',
        'prod_usage_kill_box',
        'zero_tolerance',
        'auditor_id_user',
        'vocalzation_porcent',
        'prod_porcent',
        'captive_bolt_porcent',
        'insensibility_porcent',
        'robbi_cut',
                
    ];
}
