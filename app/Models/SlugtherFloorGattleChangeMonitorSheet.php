<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlugtherFloorGattleChangeMonitorSheet extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'time',
        'monitored_by',
        
        'state',
        'carcass_num_age',
        'equipment_cleaned_and_sterilized',
   
    ];

    /*
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function monitored_by()
   {
       return $this->belongsTo(Relapse_action::class,'monitored_by');
   }
}
