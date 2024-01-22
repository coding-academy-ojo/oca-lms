<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $fillable = [
        'name', 'director', 'super_director', 'city',
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'academy_id');
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom', 'academy_id');
    }

    // Add any additional relations you need
}
