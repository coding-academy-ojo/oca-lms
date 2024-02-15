<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $fillable = [
        'name', 'photo', 'city'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_academy', 'academy_id', 'user_id');
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
