<?php



namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'en_first_name', 
        'en_second_name', 
        'en_third_name', 
        'en_last_name', 

    ];

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    // Student belongs to an Academy
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    // Student belongs to a Cohort
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function assignment()
    {
<<<<<<< HEAD
        return $this->belongsToMany(Assignment::class, 'assignment_student');
=======
        return $this->belongsToMany(Assignment::class, 'assignment_student', 'student_id', 'assignment_id');
>>>>>>> bb2dbcd6e2a8cb387597f729fd54d497ca35ba64
    }

    public function projectSubmissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'student_id');
    }

    public function projectFeedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'student_id');
    }
<<<<<<< HEAD
=======

    
    public function assignmentsubmision()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }


>>>>>>> bb2dbcd6e2a8cb387597f729fd54d497ca35ba64
}
