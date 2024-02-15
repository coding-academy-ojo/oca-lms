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

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills')->withPivot('level_id');
    }

    public function trainer()
   {
    return $this->belongsTo(User::class, 'trainer_id');
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
