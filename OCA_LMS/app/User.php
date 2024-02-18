<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'role', 'photo', 'CV', 'bio', 'academy_id'
    ];

    public function academies()
    {
        return $this->belongsToMany(Academy::class, 'user_academy', 'user_id', 'academy_id');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'user_classroom', 'user_id', 'classroom_id');
    }

// 
    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'trainee_id');
    }

    public function assignmentFeedbacks()
    {
        return $this->hasManyThrough(AssignmentFeedback::class, AssignmentSubmission::class, 'trainee_id', 'assignment_submission_id');
    }
    
    // public function assignmentFeedbacks()
    // {
    //     return $this->hasMany(AssignmentFeedback::class, 'trainer_id');
    // }

    public function projectSubmissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'trainee_id');
    }

    public function projectFeedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'trainee_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'user_id');
    }

    public function absences()
    {
        return $this->hasMany('App\Absence', 'trainee_id');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcement', 'user_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

   
}
