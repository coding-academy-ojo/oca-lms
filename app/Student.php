<?php



namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $guarded = ['id'];

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
        return $this->belongsToMany(Assignment::class, 'assignment_student', 'student_id', 'assignment_id');
    }

    public function projectSubmissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'student_id');
    }

    public function projectFeedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'student_id');
    }


    public function assignmentsubmision()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_student', 'student_id', 'project_id');
    }

      public function MasterpieceDetail()
    {
        return $this->hasOne(MasterpieceDetail::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'student_lesson_progress', 'student_id', 'lesson_id')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }

    public function lessonProgress()
    {
        return $this->hasMany(Progress::class, 'student_id');
    }
}
