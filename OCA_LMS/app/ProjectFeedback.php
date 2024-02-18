<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
    protected $fillable = ['trainer_id', 'trainee_id', 'project_id', 'feedback'];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
