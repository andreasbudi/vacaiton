<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function leaves()
    {
        return $this->belongsToMany('App\Leave', 'user_statuses', 'status_id', 'leave_id');
    }
    
    protected $fillable = ['name_status'];
}
