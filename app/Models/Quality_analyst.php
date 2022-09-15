<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quality_analyst extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'user',
        'password',
        'email',
        'departments_id'
    ];
      /**
     * Get all of the Pre_operational_sanitation for the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pre_operational_sanitation(): HasMany
    {
        return $this->hasMany(Pre_operational_sanitation::class);
    }

    /**
     * Get the Department that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departments()
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }
}
