<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre_operational_sanitation extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'aceptable',
        'date',
        'notes',
        'users_id',
        'areas_id',
        'deficiency_types_id',
        'janitors_id',
        'relapse_actions_id',
    ];

     /**
     * Get the Area that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class,'areas_id');
    }

    

     /**
     * Get the Deficiency_type that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deficiency_type()
    {
        return $this->belongsTo(Deficiency_type::class,'deficiency_types_id');
    }

   

     /**
     * Get the Janitor that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function janitor()
    {
        return $this->belongsTo(Janitor::class,'janitors_id');
    }

     /**
     * Get the Relapse_action that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relapse_action()
    {
        return $this->belongsTo(Relapse_action::class,'relapse_actions_id');
    }

    /**
     * Get the User that owns the Pre_operational_sanitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
