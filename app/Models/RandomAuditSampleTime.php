<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomAuditSampleTime extends Model
{
    use HasFactory;
    protected $table = 'random_audits'; 
    
    protected $fillable = [
        'date',
        'verification_type',
        'random_time',
        'random_num',
        'random_code',
       "users_id"
    ];

      /**
     * Get the User that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
