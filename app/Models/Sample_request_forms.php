<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample_request_forms extends Model
{
    use HasFactory;

    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'name',
      'date',
      'users_id',
      'analysis_types_id',
      'state_analisys_id',
      'areas_id',
      'sample_forms_id',
      'laboratories_id',
  ];

     /**
     * Get the Area that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class,'areas_id');
    }

    

     /**
     * Get the Deficiency_type that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }

   

     /**
     * Get the Janitor that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state_analisys()
    {
        return $this->belongsTo(State_Analisys::class,'state_analisys_id');
    }

     /**
     * Get the Relapse_action that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_analisis()
    {
        return $this->belongsTo(Test_type::class,'type_analysis_id');
    }

    /**
     * Get the Relapse_action that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sample_form()
    {
        return $this->belongsTo(Sample_form::class,'sample_forms_id');
    }

                 /**
     * Get the Relapse_action that owns the Quality_analyst
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laboratories()
    {
        return $this->belongsTo(Laboratory::class,'laboratories_id');
    }

}
