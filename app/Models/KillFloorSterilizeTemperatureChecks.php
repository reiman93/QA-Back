<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KillFloorSterilizeTemperatureChecks extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'date',
        'auditor_id',
        'priot_tostar_up',
        'temperature',
        'period1',
        'temperature1',
        'period2',
        'temperature2',
        'period3',
        'temperature3',
        'corrective_actions_taked'
    ];
}
