<?php



namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

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

    public function assignment() {
        return $this->belongsToMany(Assignment::class, 'assignment_student');
    }
}
