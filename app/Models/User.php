<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'city'
      ];

      protected $primaryKey = 'id';
      public $incrementing = false;      
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $perPage = 10;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

    public function getIdAttribute($value)
    {
      return (string)$value;
    }

    public function roles()
    {
      return $this->belongsToMany(Role::class)
          ->using(RoleUserPivot::class);            
    }

    public function permissions()
    {
      return RoleUser::orderBy('user_id')
          ->join('permission_role', 'permission_role.role_id', '=', 'role_user.role_id')
          ->where('role_user.user_id', '=', $this->id)
          ->groupBy('permission_id')
          ->get('permission_role.permission_id')
          ->map(function ($address) {
            return $address['permission_id'];
          });    
    }

    static function byRol($rol)
    {
      return self::orderBy('updated_at')
      ->join('role_user', 'role_user.user_id', '=', 'users.id')
      ->where('role_user.role_id', '=', $rol)
      ->get('users.*');
    }
}
