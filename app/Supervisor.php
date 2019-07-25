<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    public function users()
    {
        return $this->hasMany(User::class,'manager_id');
    }

    public function leaves()
    {
        return $this->belongsToMany(Leave::class, 'manager_id');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_supervisor','email'
    ];
}
