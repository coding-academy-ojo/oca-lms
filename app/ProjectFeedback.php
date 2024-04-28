<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFeedback extends Model
{
    protected $fillable = ['staff_id', 'student_id', 'project_id', 'feedback'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function submission()
    {
        return $this->belongsTo(ProjectSubmission::class, 'submission_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
