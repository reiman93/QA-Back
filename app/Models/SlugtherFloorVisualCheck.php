<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugtherFloorVisualCheck extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'period',
        'qa_user_id',
        'date',
       
        'specific_job',
        'sanitary_conditions',
        'pass_or_fails',
        'chain_speed',
        'two_nife',
        
        'reduction_comments'
    ];
}
