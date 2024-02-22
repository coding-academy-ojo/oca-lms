<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the skill_levels for the skill.
     */
    public function skillLevels()
    {
        return $this->hasMany(SkillLevel::class);
    }

    public function levels()
   {
    return $this->belongsToMany(Level::class, 'project_skills')->withPivot('level_id');
   }

    /**
     * Get the project_skills for the skill.
     */
    public function projectSkills()
    {
        return $this->hasMany(ProjectSkill::class);
    }

    /**
     * Get the traineeSkillsProgress for the skill.
     */
    public function traineeSkillsProgress()
    {
        return $this->hasMany(TraineeSkillsProgress::class);
    }

    // Add any additional relations you need
}
