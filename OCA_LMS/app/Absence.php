<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function student() {
        return $this->belongsTo(Student::class);
    }

}
