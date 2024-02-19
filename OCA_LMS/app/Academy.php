<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];




      // Academy has many Students
      public function students() {
        return $this->hasMany(Student::class);
    }

    // Academy has many Staff
    public function staff() {
        return $this->belongsToMany(Staff::class, 'academy_staff');
    }

    // Academy has many Cohorts
    public function cohorts() {
        return $this->hasMany(Cohort::class);
    }
}
