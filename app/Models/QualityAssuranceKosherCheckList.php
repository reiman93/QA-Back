<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityAssuranceKosherCheckList extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
       
        'monitor_user_id',
        
        'comments',

        'informrinsed_nife_between_carcase_type',

        'human_handing_procedure',

        'butt_push_been_backed',

        'cut_has_been_sufficient',
        
        'during_kosher_brisket',

        'neck_area_is_bane',

  //      'mark_on_sharks',

  //      'brisket_belly',
        
  //      'prior_to_any',
        
        'effectivenss_of_cut_kosher'
    ];
}
