<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $fillable = [
        'user_id', 'classroom_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function responses()
    {
        return $this->hasMany('App\AssignmentSubmission', 'trainee_id');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_feedback', 'trainee_id', 'project_id')
            ->withPivot('feedback', 'is_project_passed')
            ->withTimestamps();
    }

    public function absences()
    {
        return $this->hasMany('App\Absence', 'trainee_id');
    }

    // Add any additional relations you need
}
