<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AssignmentSubmission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'assignment_id', 'student_id', 'attached_file','is_late'
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
     public function student()
     {
         return $this->belongsTo(Student::class);
     }

     public function staff()
     {
         return $this->belongsTo(Staff::class);
     }
 

    // Add any additional relations you need
}
