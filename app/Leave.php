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

    protected $fillable = ['from', 'to', 'duration', 'reason', 'status'];
}
