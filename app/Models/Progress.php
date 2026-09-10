<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'student_lesson_progress';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['completed_at'];

    /**
     * Get the student associated with the progress.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get the lesson associated with the progress.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
