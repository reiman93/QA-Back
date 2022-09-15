<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KillFloorSterilizeTempCheck extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'locations',
        'date',
        'auditor_id',
        'relapse_actions_id',
        'priot_tostar_up',
        'temperature',
        'period',
/*         'temperature1', */
        /* 'period2', */
/*         'temperature2', */
      /*   'period3', */
/*         'temperature3', */
    ];
}
