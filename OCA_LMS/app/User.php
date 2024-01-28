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

    public function academy()
    {
        return $this->belongsTo('App\Academy');
    }

    public function trainee()
    {
        return $this->hasOne('App\Trainee', 'user_id');
    }

    public function trainer()
    {
        return $this->hasOne('App\Trainer', 'user_id');
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom', 'manager_id');
    }

    public function managedClassrooms()
    {
        return $this->hasMany('App\Classroom', 'manager_id');
    }

    public function responses()
    {
        return $this->hasMany('App\AssignmentSubmission', 'trainee_id');
    }

    public function projectSubmissions()
    {
        return $this->hasMany('App\ProjectSubmission', 'trainee_id');
    }

    public function projectFeedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'trainee_id');
    }

    public function assignmentFeedback()
    {
        return $this->hasMany('App\AssignmentFeedback', 'trainer_id');
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

    public function trainedClassrooms()
    {
        return $this->belongsToMany('App\Classroom', 'classroom_trainer');
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
