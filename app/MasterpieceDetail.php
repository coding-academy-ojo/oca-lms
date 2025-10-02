<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterpieceDetail extends Model
{

    protected $guarded = ['id'];

    // Relation with Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
