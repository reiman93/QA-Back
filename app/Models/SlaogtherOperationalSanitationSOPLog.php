<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaogtherOperationalSanitationSOPLog extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         'users_id', //user_auditor
         'date',
         'verifyed_by',
         'time',
         'inform_type',
         'periodo',
         'day_hours',
         'status',
         'corrective_action',
         'preventive_action'
    ];


        /**
     * Get the Relapse_action that owns the SOPLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relapse_action()
    {
        return $this->belongsTo(Relapse_action::class,'relapse_actions_id');
    }
   /**
    * Get the Relapse_action that owns the SOPLog
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function preventive_action()
   {
       return $this->belongsTo(PreventiveAction::class,'preventive_actions_id');
   }
       /**
     * Get the User that owns the SOPLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'verifyed_by');
    }



}
