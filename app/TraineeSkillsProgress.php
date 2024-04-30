<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraineeSkillsProgress extends Model
{
    protected $fillable = ['student_id', 'project_id', 'project_status'];

    public function trainee()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
