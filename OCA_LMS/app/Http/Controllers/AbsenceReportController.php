<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AbsenceReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $staff = Auth::guard('staff')->user();
    
            if ($staff->role == 'trainer') {
                $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
                if (!$runningCohort) {
                    return response()->json(['message' => 'No running cohort found for the trainer'], 404);
                }
                $studentsQuery = $runningCohort->students();
            } elseif ($staff->role == 'manager') {
                // Retrieve all academies assigned to the manager
                $academies = $staff->academies()->get();
            
                // Check if the manager is assigned to any academies
                if ($academies->isEmpty()) {
                    return response()->json(['message' => 'Manager is not assigned to any academies'], 404);
                }
            
                // Initialize an empty collection to store all running cohorts
                $runningCohorts = collect();
            
                // Loop through each academy to retrieve its running cohorts
                foreach ($academies as $academy) {
                    $runningCohorts = $runningCohorts->merge(
                        $academy->cohorts()->where('cohort_end_date', '>', now())->get()
                    );
                }
            
                // Check if there are any running cohorts
                if ($runningCohorts->isEmpty()) {
                    return response()->json(['message' => 'No running cohorts found'], 404);
                }
                $studentsQuery = Student::query();

            } else {
                return response()->json(['message' => 'Invalid user role'], 403);
            }
            
    
            $query = $request->input('query');
            $cohortId = $request->input('filter');
    
            try {
                if ($cohortId) {
                    // Check if the user is a manager or the selected cohort belongs to the trainer
                    if ($staff->role == 'manager' || ($staff->role == 'trainer' && $runningCohort && $runningCohort->id == $cohortId)) {
                        $studentsQuery->whereHas('cohort', function ($query) use ($cohortId) {
                            $query->where('id', $cohortId);
                        });
                    }
                }
    
                if ($query) {
                    $studentsQuery->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('en_first_name', 'LIKE', "%{$query}%")
                            ->orWhere('en_last_name', 'LIKE', "%{$query}%");
                    });
                }
    
                $students = $studentsQuery->withCount([
                    'absences as total_absent' => function ($query) {
                        $query->where('absences_type', 'absent');
                    },
                    'absences as total_late' => function ($query) {
                        $query->where('absences_type', 'late');
                    }
                ])->get();
    
                return response()->json([
                    'cohorts' => $staff->role == 'manager' ? $runningCohorts : $runningCohort,
                    'students' => $students,
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error fetching students: ' . $e->getMessage()], 500);
            }
        } else {
            return view('supermaneger.absence');
        }
    }
    
    
    
    
    
    
    
    
    
    
 
    public function show($studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
    
            // Load the absence and late records for the student
            $student->load(['absences' => function ($query) {
                $query->whereIn('absences_type', ['absent', 'late']);
            }]);
    
            return view('supermaneger.spacificUserReport', ['student' => $student]);
        } catch (ModelNotFoundException $e) {
            return back()->withError('Student not found')->withInput();
        } catch (\Exception $e) {
            return back()->withError('Error fetching student records: ' . $e->getMessage())->withInput();
        }
    }
    
}
