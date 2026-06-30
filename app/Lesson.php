<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'topic_lessons';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the topic that owns the lesson.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    /**
     * Get the progress records for this lesson.
     */
    public function progress()
    {
        return $this->hasMany(Progress::class, 'lesson_id');
    }

    /**
     * Get the students associated with this lesson via progress.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_lesson_progress', 'lesson_id', 'student_id')
                    ->withPivot('completed_at')
                    ->withTimestamps();
    }
}
