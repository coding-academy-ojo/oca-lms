<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterpieceDetail extends Model
{

    protected $guarded = ['id'];

    // Relation with Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function task()
    {
        return $this->belongsTo(MasterpieceTask::class, 'masterpiece_task_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}


