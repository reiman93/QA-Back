<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinalCordAudit extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id', //qa_user_id
        'date',
        'period',
       
        'aceptavol_value',
        'unaceptavol_value',
       
        'comments',
        
        'inked_missplits',       
    ];
}
