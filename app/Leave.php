<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function statuses()
    {
        return $this->belongsToMany('App\Status', 'user_statuses', 'leave_id', 'status_id');
    }

    public function supervisors()
    {
        return $this->belongsToMany(Supervisor::class, 'manager_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_id');
    }
    

    

    protected $fillable = ['from', 'to', 'duration', 'reason', 'status', 'user_id','role_id', 'manager_id' ];
}
