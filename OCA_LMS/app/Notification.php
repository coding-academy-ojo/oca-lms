<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Add any additional relations you need
}
