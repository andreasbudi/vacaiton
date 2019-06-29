<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function leaves()
    {
        return $this->belongsToMany(Leave::class, 'role_id');
    }
}
