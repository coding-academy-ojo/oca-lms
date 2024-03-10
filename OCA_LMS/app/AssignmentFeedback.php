<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AssignmentFeedback extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'response_id', 'trainer_id', 'feedback'
    ];

    public function assignmentSubmission()
    {
        return $this->belongsTo(AssignmentSubmission::class, 'assignment_submission_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'trainer_id');
    }

    // Add any additional relations you need

}
