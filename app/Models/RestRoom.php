<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestRoom extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auditor',
        'date',
        'time',
        'shift',
        'state',
        'sex',
        'corrective_action'
    ];

           /**
     * Get the User that owns the SOPLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corrective_action()
    {
        return $this->belongsTo(Relapse_action::class,'corrective_action');
    }

}
