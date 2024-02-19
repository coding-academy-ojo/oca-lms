<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function absences() {
        return $this->hasMany(Absence::class);
    }

    // Student belongs to an Academy
    public function academy() {
        return $this->belongsTo(Academy::class);
    }

    // Student belongs to a Cohort
    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }
}
