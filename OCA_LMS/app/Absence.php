<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'trainee_id', 'type', 'date', 'reason', 'duration'
    ];

    public function trainee()
    {
        return $this->belongsTo('App\Trainee');
    }

    // Add any additional relations you need
}
