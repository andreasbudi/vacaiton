<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function supervisors()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function leaves()
    {
        return $this->belongsToMany(Leave::class, 'user_id');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'department', 'email','email_verified_at', 'password', 'leaves_available', 'manager_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
