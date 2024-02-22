<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'delivery_date', 'cohort_id', 'staff_id'
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

    public function submissionsAndFeedback()
    {
        return $this->submissions()
            ->leftJoin('project_feedback', 'project_submissions.id', '=', 'project_feedback.submission_id')
            ->leftJoin('students', 'project_submissions.student_id', '=', 'students.id')
            ->leftJoin('staff', 'project_feedback.staff_id', '=', 'staff.id')
            ->select(
                'project_submissions.id as submission_id',
                'project_submissions.student_id', // Updated to use student_id
                'project_submissions.submission_link',
                'project_submissions.created_at as submission_created_at',
                'project_feedback.feedback',
                'project_feedback.created_at as feedback_created_at',
                'students.name as student_name',
                'students.photo as student_photo',
                'staff.name as staff_name',
                'staff.photo as staff_photo'
            )
            ->get();
    }

}
