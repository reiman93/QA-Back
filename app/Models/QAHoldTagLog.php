<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAHoldTagLog extends Model
{
    use HasFactory;
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
}
