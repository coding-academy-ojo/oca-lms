<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentFeedback extends Model
{
    protected $fillable = [
        'response_id', 'trainer_id', 'feedback'
    ];

    public function response()
    {
        return $this->belongsTo('App\AssignmentSubmission', 'response_id');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer');
    }

    // Add any additional relations you need
}
