<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'content', 'date', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Add any additional relations you need

}
