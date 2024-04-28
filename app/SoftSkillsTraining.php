<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftSkillsTraining extends Model
{
    protected $table = 'soft_skills_trainings';

    protected $fillable = [
        'name', 'description', 'trainer', 'date', 'satisfaction', 'cohort_id',
    ];


    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
