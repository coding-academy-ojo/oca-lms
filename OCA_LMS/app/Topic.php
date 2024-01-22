<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name',
    ];

    public function materials()
    {
        return $this->hasMany('App\Material', 'topic_id');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment', 'topic_id');
    }

    public function projects()
    {
        return $this->hasManyThrough('App\Project', 'App\Classroom', 'topic_id', 'classroom_id');
    }

    // Add any additional relations you need
}
