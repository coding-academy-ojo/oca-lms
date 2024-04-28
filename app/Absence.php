<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $guarded = ['id'];
    public function student() {
        return $this->belongsTo(Student::class);
    }

}
