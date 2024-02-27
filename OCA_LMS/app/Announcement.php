<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Announcement extends Model
{
    protected $fillable = [
        'content', 'date', 'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo('App\staff');
        
    }


    use SoftDeletes;

}
