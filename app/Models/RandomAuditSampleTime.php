<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomAuditSampleTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'verification_type',
        'random_time',
        'random_num',
        'random_code'
    ];
}
