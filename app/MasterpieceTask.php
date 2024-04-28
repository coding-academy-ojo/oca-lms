<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterpieceTask extends Model
{
    protected $fillable = ['task_name', 'deadline'];

    public function progress()
    {
        return $this->hasMany(MasterpieceProgress::class);
    }
    
    public static function allTaskNames()
    {
        return self::pluck('task_name', 'id');
    }
}

