<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
    protected $fillable = [
        'project_id', 'trainee_id', 'trainer_id', 'feedback', 'is_project_passed'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function trainee()
    {
        return $this->belongsTo('App\Trainee', 'trainee_id');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer', 'trainer_id');
    }

    // Add any additional relations you need
}
