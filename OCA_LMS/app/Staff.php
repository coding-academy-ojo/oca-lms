<?php

namespace App;
use App\StaffCohort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use Notifiable;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'staff';
       // Staff belongs to many Academies
       public function academies() {
        return $this->belongsToMany(Academy::class, 'academy_staff');
    }

    // Staff belongs to many Cohorts
    public function cohorts() {
        return $this->belongsToMany(Cohort::class, 'staff_cohort');
    }

    public function projectFeedback()
    {
        return $this->hasMany('App\ProjectFeedback', 'staff_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'staff_id');
    }
    
    public function getAuthPassword()
    {
        return $this->staff_password;
    }

    // public function staffCohorts()
    // {
    //     return $this->hasMany(StaffCohort::class);
    // }
}
