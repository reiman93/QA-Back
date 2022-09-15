<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaning_company extends Model
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
     * Get all of the Janitor for the Turn_type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function janitor(): HasMany
    {
        return $this->hasMany(Janitor::class);
    }
}
