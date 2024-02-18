<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSkill extends Model
{
  
    protected $fillable = ['project_id', 'skill_id', 'level_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
