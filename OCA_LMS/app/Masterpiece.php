<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Staff;

class Masterpiece extends Model
{
    use HasFactory;

    protected $table = 'masterpiece_progress';

    protected $guarded = ['id', 'student_id', 'staff_id' ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    use SoftDeletes;

}
