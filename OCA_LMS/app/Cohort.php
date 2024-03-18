<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $guarded = ['id'];

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

    public function projects()
    {
        return $this->hasMany('App\Project', 'cohort_id');
    }

    public function technology()
    {
        return $this->belongsToMany(Technology::class, 'technology__cohorts')->withPivot('start_date', 'end_date');
    }
}
