<?php

// app\Models\StaffCohort.php

namespace App\Models;
use App\cohort;
use App\staff;
use Illuminate\Database\Eloquent\Model;

class StaffCohort extends Model
{
    protected $table = 'staff_cohort';

    // Define the relationship with the Staff model
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    // Define the relationship with the Cohort model
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
