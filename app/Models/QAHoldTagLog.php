<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAHoldTagLog extends Model
{
    use HasFactory;
    protected $table = 'hold_tag_logs'; 
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'shift',
        'initials',
        'tag',
        'reason_tag_was_written',
        'product_disposition',
        'tag_pulled',
        'verifyed_by'
    ];

        /**
     * Get the User that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'verifyed_by');
    }
}
