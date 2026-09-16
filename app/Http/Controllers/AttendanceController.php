<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Academy;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    protected $qrService;

    public function __construct(QrCodeService $qrService)
    {
        $this->qrService = $qrService;
    }

    public function getDailyQr(): JsonResponse
    {
        $qrData = $this->qrService->getQrDataUrl();
        
        return response()->json([
            'qr_image' => $qrData,
            'token' => Attendance::generateDailyToken(),
            'date' => now()->toDateString(),
            'expires_at' => now()->endOfDay()->toDateTimeString()
        ]);
    }

    public function checkin(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'student_id' => 'required|integer|exists:students,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180'
        ]);

        $token = $request->input('token');
        $studentId = $request->input('student_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (!Attendance::isValidToken($token)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired QR token'
            ], 400);
        }

        $student = Student::with('academy')->find($studentId);
        
        if ($latitude && $longitude && $student->academy) {
            $academy = $student->academy;
            if ($academy->latitude && $academy->longitude) {
                $radius = $academy->radius_meters ?? 100;
                $distance = $this->calculateDistance(
                    $latitude,
                    $longitude,
                    $academy->latitude,
                    $academy->longitude
                );
                
                if ($distance > $radius) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You must be at the academy to check in. Distance: ' . round($distance) . 'm away from academy.'
                    ], 403);
                }
            }
        }

        $today = now()->toDateString();
        
        $existingAttendance = Attendance::where('student_id', $studentId)
            ->where('date', $today)
            ->first();

        if ($existingAttendance && $existingAttendance->check_in_time) {
            return response()->json([
                'success' => false,
                'message' => 'You have already checked in today',
                'attendance' => $existingAttendance
            ], 409);
        }

        $checkInTime = now()->format('H:i:s');
        $status = Attendance::markStatus($checkInTime);

        $attendanceData = [
            'check_in_time' => $checkInTime,
            'status' => $status,
            'qr_token' => $token,
            'ip_address' => $request->ip()
        ];

        if ($latitude && $longitude) {
            $attendanceData['latitude'] = $latitude;
            $attendanceData['longitude'] = $longitude;
        }

        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $studentId,
                'date' => $today
            ],
            $attendanceData
        );

        $student = Student::find($studentId);
        
        // Check multiple possible name fields
        $firstName = $student->en_first_name ?? $student->first_name ?? $student->ar_first_name ?? '';
        $lastName = $student->en_last_name ?? $student->last_name ?? $student->ar_last_name ?? '';
        
        $studentName = $firstName . ' ' . $lastName;

        return response()->json([
            'success' => true,
            'message' => $status === 'present' ? 'Check-in successful!' : 'You are marked as late',
            'attendance' => [
                'id' => $attendance->id,
                'student_name' => trim($studentName),
                'student_id' => $studentId,
                'date' => $attendance->date,
                'check_in_time' => $attendance->check_in_time,
                'status' => $attendance->status
            ]
        ]);
    }

    public function checkout(Request $request): JsonResponse
    {
        $request->validate([
            'student_id' => 'required|integer|exists:students,id'
        ]);

        $studentId = $request->input('student_id');
        $today = now()->toDateString();

        $attendance = Attendance::where('student_id', $studentId)
            ->where('date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in_time) {
            return response()->json([
                'success' => false,
                'message' => 'No check-in record found for today'
            ], 404);
        }

        if ($attendance->check_out_time) {
            return response()->json([
                'success' => false,
                'message' => 'You have already checked out today'
            ], 409);
        }

        $checkOutTime = now()->format('H:i:s');
        $leaveStatus = Attendance::markLeaveStatus($checkOutTime);
        
        $newStatus = $leaveStatus;
        
        $attendance->update([
            'check_out_time' => $checkOutTime,
            'status' => $newStatus
        ]);

        $student = Student::find($studentId);
        $studentName = $student->en_first_name . ' ' . $student->en_last_name;

        return response()->json([
            'success' => true,
            'message' => $leaveStatus === 'left_early' ? 'Checked out early!' : 'Check-out successful!',
            'attendance' => [
                'id' => $attendance->id,
                'student_name' => trim($studentName),
                'student_id' => $studentId,
                'check_in_time' => $attendance->check_in_time,
                'check_out_time' => $attendance->check_out_time,
                'status' => $attendance->status
            ]
        ]);
    }

    public function myAttendance(Request $request): JsonResponse
    {
        $request->validate([
            'student_id' => 'required|integer|exists:students,id'
        ]);

        $studentId = $request->input('student_id');
        $startDate = $request->input('start_date', now()->subMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $attendances = Attendance::where('student_id', $studentId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        $stats = [
            'total_days' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'excused' => $attendances->where('status', 'excused')->count(),
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'attendances' => $attendances
        ]);
    }

    public function getAttendanceByCohort(Request $request, $cohortId): JsonResponse
    {
        $date = $request->input('date', now()->toDateString());

        $students = Student::where('cohort_id', $cohortId)->get();
        
        $attendanceData = [];
        
        foreach ($students as $student) {
            $attendance = Attendance::where('student_id', $student->id)
                ->where('date', $date)
                ->first();
                
            $attendanceData[] = [
                'student_id' => $student->id,
                'student_name' => $student->first_name . ' ' . $student->last_name,
                'check_in_time' => $attendance?->check_in_time,
                'check_out_time' => $attendance?->check_out_time,
                'status' => $attendance?->status ?? 'absent'
            ];
        }

        $presentCount = collect($attendanceData)->where('status', 'present')->count();
        $lateCount = collect($attendanceData)->where('status', 'late')->count();
        $absentCount = collect($attendanceData)->where('status', 'absent')->count();

        return response()->json([
            'success' => true,
            'date' => $date,
            'total_students' => $students->count(),
            'present' => $presentCount,
            'late' => $lateCount,
            'absent' => $absentCount,
            'students' => $attendanceData
        ]);
    }


    
    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000;

        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);
        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLon = deg2rad($lon2 - $lon1);

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLon / 2) * sin($deltaLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }


    public function changeAllStatus(Request $request, $cohortId): JsonResponse
{
    $request->validate([
        'status' => 'required|in:present,late,absent,excused',
        'date' => 'nullable|date',
    ]);

    $date = $request->input('date', now()->toDateString());

    $students = Student::where('cohort_id', $cohortId)->get();

    foreach ($students as $student) {
        Attendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'date' => $date,
            ],
            [
                'status' => $request->status,
            ]
        );
    }

    return response()->json([
        'success' => true,
        'message' => 'All students status updated successfully.',
        'status' => $request->status,
        'total_students' => $students->count(),
        'date' => $date,
    ]);
}
}