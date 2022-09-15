<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KillFloorPreOpSanitationSwab extends Model
{
    use HasFactory;
       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'audited_by',
        'date',
        'reviewed_by',
        'area',
        'aceptable',
        'sanitzer_titration',
        'sanitzer_typ',
        'qa_start_time',
         'usda_start_time',
         'floor_release_time',
         'down_time',
         
    ];
}

