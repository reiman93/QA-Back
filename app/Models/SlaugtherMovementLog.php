<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlaugtherMovementLog extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
               
        'monitored_by',
       
        'beginig_carcase_tag',
        
        'ending_carcase_tag',
       
        'no30',
      
        'definition', // denition
       
        'supplier_name', //suppler_name
        
        'lot_num',
       
        'carcases_grag_tag_num'

    ];
}
