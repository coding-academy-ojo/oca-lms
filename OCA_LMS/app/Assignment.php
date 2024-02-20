<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    // Relationship with AssignmentSubmissions
    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // Relationship with AssignmentFeedbacks through AssignmentSubmissions for Trainees
    public function assignmentFeedbacks()
    {
        return $this->hasManyThrough(
            AssignmentFeedback::class,
            AssignmentSubmission::class,
            'assignment_id',
            'assignment_submission_id',
            'id',
            'id'
        );
    }

    public function student() {
        return $this->belongsToMany(Student::class, 'assignment_student');
    }

    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }

    // Add any additional relations you need
}
