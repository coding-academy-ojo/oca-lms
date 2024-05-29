<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterpieceTask extends Model
{
    protected $fillable = ['task_name', 'deadline'];
    
    public static function allTaskNames()
    {
        return self::pluck('task_name', 'id');
    }
    public function masterpieceProgress()
    {
        return $this->belongsToMany(Masterpiece::class, 'task_id');
    }
}

