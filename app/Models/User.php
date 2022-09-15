<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'username',
        'password',
        'foto',
        'rols_id',
        'departments_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   /* protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

     /**
   * Get the Turn_type that owns the Janitor
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function rols()
  {
      return $this->belongsTo(Rol::class,"rols_id");
  }
  public function departments()
  {
      return $this->belongsTo(Rol::class,"departments_id");
  }

       /**
   * Get all of the Pre_operational_sanitation for the area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function sample_request_forms()
  {
      return $this->hasMany(Sample_request_forms::class,'users_id');
  }

       /**
   * Get all of the Pre_operational_sanitation for the area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function pre_operational_sanitation()
  {
      return $this->hasMany(Pre_operational_sanitation::class,'users_id');
  }

         /**
   * Get all of the Pre_operational_sanitation for the area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function slaugther()
  {
      return $this->hasMany(SlaogtherOperationalSanitationSOPLog::class,'verifyed_by','id');
  }

  /**
   * Get all of the Pre_operational_sanitation for the area
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function slaugtherFloor()
  {
      return $this->hasMany(SlaogtherOperationalSanitationSOPLog::class,'monitored_by','id');
  }

}
