<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NozzleInspectionForm extends Model
{
    use HasFactory;
          /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auditor',
        'date',
        'process',
        'period',
        'time',
        'lactic_mp3',

        'nozzals_working',
        'plugged_nozzles',
        'propper_alications',
        'product_sprend_out',

    ];

}
