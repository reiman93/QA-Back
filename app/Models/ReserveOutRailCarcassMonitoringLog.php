<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveOutRailCarcassMonitoringLog extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'shift',
        'carcasse_ID_number',
        'reason',
        'time_out',
        'time_checked',
        'dropped_carcass',
        'min_45',
        'may_45',
        'zero_tolerance',
        'auditor_id_user'        
    ];
}
