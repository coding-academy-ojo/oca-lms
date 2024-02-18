<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentFeedback extends Model
{
    protected $fillable = [
        'response_id', 'trainer_id', 'feedback'
    ];

    public function assignmentSubmission()
    {
        return $this->belongsTo(AssignmentSubmission::class, 'assignment_submission_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    // Add any additional relations you need

}
