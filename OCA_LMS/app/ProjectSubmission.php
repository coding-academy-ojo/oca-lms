<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $fillable = [
        'project_id', 'trainee_id', 'link', 'text_submission'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function trainee()
    {
        return $this->belongsTo('App\Trainee', 'trainee_id');
    }
 
    // Add any additional relations you need
}
