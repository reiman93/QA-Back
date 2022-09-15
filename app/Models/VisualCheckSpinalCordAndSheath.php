<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisualCheckSpinalCordAndSheath extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'carcase',

        'removed',

        'slaugther_cooler_supy',

        'qa_notified',   //qa_notified
        
        'qa_id'       //qa_id
    ];  

    public function qa_notified()
    {
        return $this->belongsTo(User::class,'qa_notified');
    }

    public function qa_id()
    {
        return $this->belongsTo(User::class,'qa_id');
    }


}
