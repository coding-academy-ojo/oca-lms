<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraineeSkillsProgress extends Model
{
    protected $fillable = ['trainee_id', 'project_id', 'skill_id', 'level_id', 'achieved'];

    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function skillLevel()
    {
        return $this->belongsTo(SkillLevel::class, 'skill_id', 'level_id');
    }
}
