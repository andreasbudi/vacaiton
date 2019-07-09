<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function leaves()
    {
        return $this->belongsToMany(Leave::class,'status');
    }
    
    protected $fillable = ['name_status'];
}
