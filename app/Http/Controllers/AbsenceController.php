<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AbsenceController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $filteredDate = $request->date ?? Carbon::today()->toDateString();
        $academiesQuery = Academy::query();
        $cohortsQuery = Cohort::query();
        
        $latestCohort = Cohort::orderBy('created_at', 'desc')->first();
        $defaultCohortId = $request->cohort_id ?? $latestCohort->id ?? null;
        
        $studentsQuery = Student::select('id', 'en_first_name', 'en_last_name', 'academy_id', 'cohort_id')
          ->with(['academy' => function($query) {
              $query->select('id', 'academy_name', 'latitude', 'longitude', 'radius_meters');
          }, 'cohort' => function($query) {
              $query->select('id', 'cohort_name');
          }]);

         if ($staff->role === 'super_manager') {
             // No restriction, can access all data
         } elseif ($staff->role === 'manager') {
             $academyIds = $staff->academies->pluck('id');
             $academiesQuery->whereIn('id', $academyIds);
             $cohortsQuery->whereIn('academy_id', $academyIds);
             $studentsQuery->whereHas('academy', function ($query) use ($academyIds) {
                 $query->whereIn('id', $academyIds);
             });
         } elseif (in_array($staff->role, ['trainer', 'coordinator', 'job_coach', 'auditer'])) {
             $cohortsIds = $staff->cohorts->pluck('id');
             $cohortsQuery->whereIn('id', $cohortsIds);
             $academiesQuery->whereHas('cohorts', function ($query) use ($cohortsIds) {
                 $query->whereIn('id', $cohortsIds);
             });
             $studentsQuery->whereHas('cohort', function ($query) use ($cohortsIds) {
                 $query->whereIn('id', $cohortsIds);
             });
         }
 
          // Filtering students based on academy and cohort
          if ($request->filled('academy_id')) {
              $studentsQuery->where('academy_id', $request->academy_id);
              $cohortsQuery->where('academy_id', $request->academy_id);
          }
          
          $cohortFilter = $request->cohort_id ?? $defaultCohortId;
          if ($cohortFilter) {
              $studentsQuery->where('cohort_id', $cohortFilter);
          }
  
          $academies = $academiesQuery->get();
          
          $cohortsQuery = Cohort::query();
          if ($request->filled('academy_id')) {
              $cohortsQuery->where('academy_id', $request->academy_id);
          }
          $cohorts = $cohortsQuery->orderBy('created_at', 'desc')->get();
 
          $students = $studentsQuery->get()->map(function ($student) use ($filteredDate) {
           
             $absence = $student->absences()->whereDate('absences_date', $filteredDate)->first(['absences_type', 'absences_reason', 'absences_duration']);
              $attendance = $student->attendances()->whereDate('date', $filteredDate)->first(['check_in_time', 'check_out_time', 'status', 'latitude', 'longitude']);
              
              $gpsStatus = 'no_gps';
              $gpsDistance = null;
              
              if ($attendance && $attendance->latitude && $attendance->longitude && $student->academy) {
                  $academy = $student->academy;
                  if ($academy->latitude && $academy->longitude) {
                      $radius = $academy->radius_meters ?? 100;
                      $distance = $this->calculateDistance(
                          $attendance->latitude,
                          $attendance->longitude,
                          $academy->latitude,
                          $academy->longitude
                      );
                      $gpsDistance = round($distance);
                      $gpsStatus = $distance <= $radius ? 'inside' : 'outside';
                  }
              }
              
              $statusFromAbsence = optional($absence)->absences_type;
              $statusFromAttendance = optional($attendance)->status;
              
              if ($statusFromAbsence) {
                  $finalStatus = $statusFromAbsence;
              } elseif ($statusFromAttendance) {
                  $finalStatus = $statusFromAttendance;
              } else {
                  $finalStatus = 'absent';
              }
              
              $lateMinutes = null;
              if ($attendance && $attendance->check_in_time) {
                  $checkIn = Carbon::parse($attendance->check_in_time);
                  $threshold = Carbon::parse('09:00:00');
                  if ($checkIn->gt($threshold)) {
                      $lateMinutes = $checkIn->diffInMinutes($threshold);
                  }
              }
              
              $leaveMinutes = null;
              if ($attendance && $attendance->check_out_time) {
                  $checkOut = Carbon::parse($attendance->check_out_time);
                  $leaveThreshold = Carbon::parse('18:00:00');
                  if ($checkOut->lt($leaveThreshold)) {
                      $leaveMinutes = $leaveThreshold->diffInMinutes($checkOut);
                  }
              }
              
              return [
                  'id' => $student->id,
                  'en_first_name' => $student->en_first_name,
                  'en_last_name' => $student->en_last_name,
                  'attendanceStatus' => $finalStatus,
                  'absenceReason' => optional($absence)->absences_reason,
                  'absenceDuration' => optional($absence)->absences_duration ?? $lateMinutes,
                  'checkInTime' => optional($attendance)->check_in_time,
                  'checkOutTime' => optional($attendance)->check_out_time,
                  'leaveMinutes' => $leaveMinutes,
                  'checkInDate' => $filteredDate,
                  'checkInDay' => Carbon::parse($filteredDate)->format('l'),
                  'gpsLatitude' => optional($attendance)->latitude,
                  'gpsLongitude' => optional($attendance)->longitude,
                  'gpsStatus' => $gpsStatus,
                  'gpsDistance' => $gpsDistance,
              ];
         });
       
          $counts = [
              'all' => $students->count(),
              'present' => $students->where('attendanceStatus', 'present')->count(),
              'absent' => $students->where('attendanceStatus', 'absent')->count(),
              'late' => $students->where('attendanceStatus', 'late')->count(),
              'excused' => $students->where('attendanceStatus', 'excused')->count(),
          ];
         if ($request->ajax() && $request->header('x-requested-with') == 'XMLHttpRequest') {
             $response = response()->json([
                 'students' => $students,
                 'counts' => $counts,
                 'academies' => $academies,
                 'cohorts' => $cohorts,
                 'defaultCohortId' => $defaultCohortId,
             ]);
    
           
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
    
            return $response;
    
   
        }

        return response()->view('supermaneger.attendance', compact('students', 'counts', 'academies', 'cohorts'))
                         ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                         ->header('Pragma', 'no-cache')
                         ->header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
    }
    
    
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }


    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:present,late,absent,excused,left_early,completed',
            'reason' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d',
            'absences_duration' => 'nullable|integer|min:0',
        ]);

        $date = Carbon::parse($request->date)->toDateString();
        $status = $request->status;
        $duration = $request->absences_duration ?? 0;
        $reason = $request->reason ?? null;

        $student = Student::find($request->student_id);

        // For present, completed - remove any absence record and update attendance
        if ($status === 'present' || $status === 'completed') {
            Absence::where('student_id', $request->student_id)
                   ->whereDate('absences_date', $date)
                   ->delete();

            if ($student) {
                $attendance = Attendance::firstOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'date' => $date,
                    ],
                    [
                        'check_in_time' => '09:00:00',
                        'status' => $status,
                    ]
                );

                if ($attendance) {
                    $attendance->update([
                        'status' => $status,
                    ]);
                }
            }

            return response()->json([
                'message' => 'Attendance record updated successfully.',
            ]);
        }

        // For late status - save duration in absence table and update attendance
        if ($status === 'late') {
            // Delete any existing absence for this date
            Absence::where('student_id', $request->student_id)
                   ->whereDate('absences_date', $date)
                   ->delete();

            // Create absence record with duration
            $absence = Absence::create([
                'student_id' => $request->student_id,
                'absences_type' => 'late',
                'absences_date' => $date,
                'absences_reason' => $reason,
                'absences_duration' => $duration,
            ]);

            // Update or create attendance record
            if ($student) {
                $attendance = Attendance::firstOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'date' => $date,
                    ],
                    [
                        'check_in_time' => '09:00:00',
                        'status' => 'late',
                    ]
                );

                if ($attendance) {
                    $attendance->update([
                        'status' => 'late',
                    ]);
                }
            }

            return response()->json([
                'message' => 'Late attendance record saved successfully.',
                'absence' => $absence,
            ]);
        }

        // For absent or excused status
        if ($status === 'absent' || $status === 'excused') {
            $absenceType = $status;

            $absence = Absence::updateOrCreate(
                [
                    'student_id' => $request->student_id,
                    'absences_date' => $date,
                ],
                [
                    'absences_type' => $absenceType,
                    'absences_reason' => $reason,
                    'absences_duration' => $duration,
                ]
            );

            if ($student) {
                Attendance::firstOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'date' => $date,
                    ],
                    [
                        'status' => $status,
                    ]
                );
            }

            return response()->json([
                'message' => 'Absence record saved successfully.',
                'absence' => $absence,
            ]);
        }

        // For left_early status
        if ($status === 'left_early') {
            $absence = Absence::updateOrCreate(
                [
                    'student_id' => $request->student_id,
                    'absences_date' => $date,
                ],
                [
                    'absences_type' => 'leaving',
                    'absences_reason' => $reason,
                    'absences_duration' => $duration,
                ]
            );

            if ($student) {
                $attendance = Attendance::firstOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'date' => $date,
                    ],
                    [
                        'check_in_time' => '09:00:00',
                        'status' => 'left_early',
                    ]
                );

                if ($attendance) {
                    $attendance->update(['status' => 'left_early']);
                }
            }

            return response()->json([
                'message' => 'Left early record saved successfully.',
                'absence' => $absence,
            ]);
        }

        return response()->json([
            'message' => 'Invalid status provided.',
        ], 400);
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


    public function changeAllStatus(Request $request, $cohortId)
{
    $request->validate([
        'status' => 'required|in:present,late,absent,excused',
        'date' => 'required|date_format:Y-m-d',
        'absences_duration' => 'nullable|integer|min:0',
        'reason' => 'nullable|string',
    ]);

    $date = Carbon::parse($request->date)->toDateString();
    $status = $request->status;
    $duration = $request->absences_duration ?? 0;
    $reason = $request->reason ?? null;

    // Get all students in this cohort
    $students = Student::where('cohort_id', $cohortId)->get();

    if ($students->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No students found in this cohort.'
        ], 404);
    }

    foreach ($students as $student) {

        // ==========================================
        // PRESENT
        // ==========================================
        if ($status === 'present') {

            // Remove absence record
            Absence::where('student_id', $student->id)
                ->whereDate('absences_date', $date)
                ->delete();

            // Create/update attendance
            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'date' => $date,
                ],
                [
                    'check_in_time' => '09:00:00',
                    'status' => 'present',
                ]
            );
        }

        // ==========================================
        // LATE
        // ==========================================
        elseif ($status === 'late') {

            // Remove previous absence record
            Absence::where('student_id', $student->id)
                ->whereDate('absences_date', $date)
                ->delete();

            // Create late absence record
            Absence::create([
                'student_id' => $student->id,
                'absences_type' => 'late',
                'absences_date' => $date,
                'absences_reason' => $reason,
                'absences_duration' => $duration,
            ]);

            // Create/update attendance
            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'date' => $date,
                ],
                [
                    'check_in_time' => '09:00:00',
                    'status' => 'late',
                ]
            );
        }

        // ==========================================
        // ABSENT / EXCUSED
        // ==========================================
        elseif ($status === 'absent' || $status === 'excused') {

            Absence::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'absences_date' => $date,
                ],
                [
                    'absences_type' => $status,
                    'absences_reason' => $reason,
                    'absences_duration' => $duration,
                ]
            );

            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'date' => $date,
                ],
                [
                    'status' => $status,
                ]
            );
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'All students attendance status updated successfully.',
        'total_students' => $students->count(),
        'status' => $status,
        'date' => $date,
    ]);
}
    
    
}


