<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    protected $fillable = ['skill_id', 'level_id', 'skillLevels_description'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
