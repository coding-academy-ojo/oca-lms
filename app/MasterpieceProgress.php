<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Staff;
use App\MasterpieceTask;
class MasterpieceProgress extends Model 
{
    protected $table = 'masterpiece_progress';

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(MasterpieceTask::class, 'masterpiece_progress_task', 'masterpiece_progress_id', 'masterpiece_task_id');
    }
}

