<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaogtherOperationalSanitationSOPLogSheetSupplemental extends Model
{
    use HasFactory;
    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
    protected $fillable = [
        'user_auditor',
        'date',
        'verifyed_by',
        'decfects_description',
        'disposition_of_product',
         'restoration_sanitary_condition',
         'root_cause',
         'Further_planned_actions',
    ];
}
