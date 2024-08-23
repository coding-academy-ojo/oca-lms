<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Academy;
use App\Cohort;
use App\Student;
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
        //  dd($staff);
         $filteredDate = $request->date ?? Carbon::today()->toDateString();
         $academiesQuery = Academy::query();
         $cohortsQuery = Cohort::query();
         $studentsQuery = Student::select('id', 'en_first_name', 'en_last_name', 'academy_id', 'cohort_id')
         ->with(['academy' => function($query) {
             $query->select('id', 'academy_name');
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
         } elseif ($staff->role === 'trainer') {
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
         if ($request->filled('cohort_id')) {
             $studentsQuery->where('cohort_id', $request->cohort_id);
         }
 
         $academies = $academiesQuery->get();
         $cohorts = $cohortsQuery->get();
 
         $students = $studentsQuery->get()->map(function ($student) use ($filteredDate) {
          
            $absence = $student->absences()->whereDate('absences_date', $filteredDate)->first(['absences_type', 'absences_reason', 'absences_duration']);
            return [
                'id' => $student->id,
                'en_first_name' => $student->en_first_name,
                'en_last_name' => $student->en_last_name,
                'attendanceStatus' => optional($absence)->absences_type ?? 'attended',
                'absenceReason' => optional($absence)->absences_reason,
                'absenceDuration' => optional($absence)->absences_duration,
            ];
        });
       
         $counts = [
             'all' => $students->count(),
             'attended' => $students->where('attendanceStatus', 'attended')->count(),
             'absent' => $students->where('attendanceStatus', 'absent')->count(),
             'late' => $students->where('attendanceStatus', 'late')->count(),
             'leaving' => $students->where('attendanceStatus', 'leaving')->count(),
         ];
         if ($request->ajax() && $request->header('x-requested-with') == 'XMLHttpRequest') {
            $response = response()->json([
                'students' => $students,
                'counts' => $counts,
                'academies' => $academies,
                'cohorts' => $cohorts,
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
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absence
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
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence)
    {
        //
    }


    public function storeOrUpdate(Request $request)
    {
        // Validate the request data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|in:attended,late,absent,leaving',
            'reason' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d',
            'absences_duration' => 'nullable|integer|min:0', // Make nullable because it's not needed for 'attended'
        ]);
    
        $date = Carbon::parse($request->date)->toDateString();
    
        // If the status is 'attended', check for an absence record and delete it if it exists
        if ($request->status === 'attended') {
            Absence::where('student_id', $request->student_id)
                   ->whereDate('absences_date', $date)
                   ->delete();
    
            return response()->json([
                'message' => 'Attendance record updated successfully.',
            ]);
        }
    
        // Otherwise, update or create the absence record
        $absence = Absence::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'absences_date' => $date,
            ],
            [
                'absences_type' => $request->status,
                'absences_reason' => $request->reason ?? null,
                'absences_duration' => $request->absences_duration ?? 0, // Default to 0 if not provided
            ]
        );
    
        // Return a successful response
        return response()->json([
            'message' => 'Absence record saved successfully.',
            'absence' => $absence,
        ]);
    }
    
    
}
