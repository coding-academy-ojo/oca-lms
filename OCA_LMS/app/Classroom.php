<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'description', 'picture', 'academy_id', 'manager_id', 'trainer_id',
    ];

    public function academy()
    {
        return $this->belongsTo('App\Academy');
    }

    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer', 'trainer_id');
    }

    public function trainees()
    {
        return $this->hasMany('App\Trainee', 'classroom_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'classroom_id');
    }

    // Add any additional relations you need
}
