<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStatus extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

      /**
   * Get all of the Pre_operational_sanitation for the TestStatus
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pre_operational_sanitation()
  {
      return $this->hasMany(Pre_operational_sanitation::class,'TestStatuss_id');
  }
}
