<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'subject_name', 'attached_file', 'resources_link', 'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
    

    // Add any additional relations you need
}
