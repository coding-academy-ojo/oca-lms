<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'delivery_date', 'cohort_id', 'staff_id','project_type'
    ];

    public function cohort()
    {
        return $this->belongsTo('App\Cohort');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skills')->withPivot('level_id');
    }

    public function staff()
   {
    return $this->belongsTo(Staff::class, 'staff_id');
   }

    public function submissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'project_id');
    }

    public function feedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'project_id');
    }

    public function students()
{
    return $this->belongsToMany(Student::class, 'project_student', 'project_id', 'student_id');
}


public function submissionsAndFeedback($projectId, $studentId)
{
    return $this->submissions()
        ->leftJoin('project_feedback', 'project_submissions.id', '=', 'project_feedback.submission_id')
        ->leftJoin('students', 'project_submissions.student_id', '=', 'students.id')
        ->leftJoin('staff', 'project_feedback.staff_id', '=', 'staff.id')
        ->where('project_submissions.student_id', $studentId)
        ->where('project_submissions.project_id', $projectId)
        ->select(
            'project_submissions.id as submission_id',
            'project_submissions.student_id',
            'project_submissions.submission_link',
            'project_submissions.submission_message',
            'project_submissions.created_at as submission_created_at',
            'project_feedback.feedback',
            'project_feedback.created_at as feedback_created_at',
            'students.en_first_name as student_name',
            'students.personal_img as student_photo',
            'staff.staff_name as staff_name',
            'staff.staff_personal_img as staff_photo'
        )
        ->get();
}


}
