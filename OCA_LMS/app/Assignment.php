<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'name', 'due_date', 'attached_file','topic_id'
    ];

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

    // Add any additional relations you need
}
