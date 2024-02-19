<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

       // Staff belongs to many Academies
       public function academies() {
        return $this->belongsToMany(Academy::class, 'academy_staff');
    }

    // Staff belongs to many Cohorts
    public function cohorts() {
        return $this->belongsToMany(Cohort::class, 'staff_cohort');
    }
}
