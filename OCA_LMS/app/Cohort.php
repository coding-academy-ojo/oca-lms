<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

     // Cohort belongs to an Academy
     public function academy() {
        return $this->belongsTo(Academy::class);
    }

    // Cohort has many Students
    public function students() {
        return $this->hasMany(Student::class);
    }

    // Cohort belongs to many Staff
    public function staff() {
        return $this->belongsToMany(Staff::class, 'staff_cohort');
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
