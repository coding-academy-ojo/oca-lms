<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id', 'trainee_id', 'attached_file'
    ];

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function trainee()
    {
        return $this->belongsTo('App\Trainee');
    }

    // Add any additional relations you need
}
