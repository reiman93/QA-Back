<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Janitor extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'turn_types_id',
        'cleaning_companies_id'
    ];
  /**
   * Get the Turn_type that owns the Janitor
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function turn_type(): BelongsTo
  {
      return $this->belongsTo(Turn_type::class,"turn_types_id");
  }

    /**
   * Get the Turn_type that owns the Janitor
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cleaning_company()
  {
      return $this->belongsTo(Cleaning_company::class,"cleaning_companies_id");
  }
       /**
     * Get all of the Quality_analyst for the Janitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pre_operational_sanitation()
    {
        return $this->hasMany(Quality_analyst::class,"janitors_id");
    }
}
