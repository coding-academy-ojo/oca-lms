<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $fillable = ['name'];

    /**
     * Get the skill_levels for the level.
     */
    public function skillLevels()
    {
        return $this->hasMany(SkillLevel::class);
    }

    /**
     * Get the project_skills for the level.
     */
    public function projectSkills()
    {
        return $this->hasMany(ProjectSkill::class);
    }

    /**
     * Get the traineeSkillsProgress for the level.
     */
    public function traineeSkillsProgress()
    {
        return $this->hasMany(TraineeSkillsProgress::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills')->withPivot('level_id');
    }
}
