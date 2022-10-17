<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DedicatedEquipmentAuditForm extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'period',
        'hand_drop',
        'spinal_cord',
        'limit',
        'defect_description',
        'lot_number',
        'corrective_action_id', //relapse_id??
        'preventive_action_id', //new??
        'time',
        'date',
        'users_id' //user_auditor?
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
