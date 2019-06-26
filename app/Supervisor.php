<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    public function employees()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
