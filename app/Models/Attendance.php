<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public static function generateDailyToken()
    {
        $date = now()->toDateString();
        $secret = config('app.key');
        return hash('sha256', $date . $secret);
    }

    public static function isValidToken($token)
    {
        return $token === self::generateDailyToken();
    }

    public static function getLateThreshold()
    {
        return config('attendance.late_threshold', '09:00:00');
    }

    public static function getEarlyLeaveThreshold()
    {
        return config('attendance.early_leave_threshold', '14:00:00');
    }

    public static function markStatus($checkInTime)
    {
        $threshold = self::getLateThreshold();
        if ($checkInTime <= $threshold) {
            return 'present';
        }
        return 'late';
    }

    public static function markLeaveStatus($checkOutTime)
    {
        $threshold = self::getEarlyLeaveThreshold();
        if ($checkOutTime < $threshold) {
            return 'left_early';
        }
        return 'completed';
    }
}