<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChlorineNozzleInspection extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auditor_user_id', //auditor_user_id
       
        'date',
        'action',
        'period',
        'time',
        'clorine',
        'nozzels_working_propiety',
        'flugged_nozzels',
        'barrel_checked',
        'chlorine_added',
        'comments'
    ];
}
