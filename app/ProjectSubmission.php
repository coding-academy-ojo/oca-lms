<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $fillable = [
        'project_id', 'student_id', 'submission_link','submission_message'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function feedback()
    {
        return $this->hasMany(ProjectFeedback::class, 'submission_id');
    }
}
