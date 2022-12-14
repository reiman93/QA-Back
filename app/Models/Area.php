<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'state'
    ];

      /**
   * Get all of the Pre_operational_sanitation for the area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pre_oper_sanitations()
  {
      return $this->hasMany(Pre_operational_sanitation::class,'pre_oper_sanittions_id');
  }
}
