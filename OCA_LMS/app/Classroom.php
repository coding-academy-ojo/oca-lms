<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name', 'description', 'picture', 'academy_id'
    ];

    public function academy()
    {
        return $this->belongsTo('App\Academy');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_classroom', 'classroom_id', 'user_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'classroom_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
   
    // Add any additional relations you need
}
