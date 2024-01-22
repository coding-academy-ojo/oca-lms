<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSkill extends Model
{
    protected $fillable = [
        'project_id', 'skill_id', 'level'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }

    // Add any additional relations you need
}
