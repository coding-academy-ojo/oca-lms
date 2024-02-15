<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id', 'trainee_id', 'attached_file','is_late'
    ];

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function assignmentFeedback()
    {
        return $this->hasOne(AssignmentFeedback::class, 'assignment_submission_id');
    }
     // Relationship with User (Trainee)
     public function trainee()
     {
         return $this->belongsTo(User::class, 'trainee_id');
     }
 

    // Add any additional relations you need
}
