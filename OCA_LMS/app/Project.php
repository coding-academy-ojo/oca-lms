<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'delivery_date', 'classroom_id', 'trainer_id'
    ];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'project_skills', 'project_id', 'skill_id')
            ->withPivot('level');
    }

    public function submissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'project_id');
    }

    public function feedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'project_id');
    }

    // Add any additional relations you need
}
