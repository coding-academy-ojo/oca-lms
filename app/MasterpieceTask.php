<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterpieceTask extends Model
{
    protected $guarded = ['id'];
    
    public static function allTaskNames()
    {
        return self::pluck('task_name', 'id');
    }
    
    public function masterpieceProgress()
    {
        return $this->belongsToMany(MasterpieceProgress::class, 'masterpiece_progress_task', 'masterpiece_task_id', 'masterpiece_progress_id')->withPivot('id');
    }
}

