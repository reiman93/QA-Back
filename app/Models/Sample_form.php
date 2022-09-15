<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample_form extends Model
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
   * Get all of the Pre_operational_sanitation for the SampleForm
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pre_operational_sanitation()
  {
      return $this->hasMany(Pre_operational_sanitation::class,'sample_forms_id');
  }
}

