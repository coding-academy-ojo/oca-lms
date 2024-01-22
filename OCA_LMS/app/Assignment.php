<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'name', 'submission_date', 'attached_file', 'is_late', 'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    public function responses()
    {
        return $this->hasMany('App\AssignmentSubmission', 'assignment_id');
    }

    // Add any additional relations you need
}
