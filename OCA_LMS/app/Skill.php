<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name', 'level'
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_skills', 'skill_id', 'project_id')
            ->withPivot('level');
    }

    // Add any additional relations you need
}
