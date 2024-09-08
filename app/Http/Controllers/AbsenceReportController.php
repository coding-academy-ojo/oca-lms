<?php

namespace App\Http\Controllers;
use App\Student;
use App\Absence;
use App\Cohort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class AbsenceReportController extends Controller
{
    public function index(Request $request, $cohort_id = null)
    {
        try {
            if ($cohort_id) {
                $decryptedCohortId = Crypt::decryptString($cohort_id);
                session(['selected_cohort_id' => $decryptedCohortId]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid or expired cohort ID'], 400);
        }
        if ($request->ajax()) {
            $staff = Auth::guard('staff')->user();
    
            $selectedCohortId = $cohort_id ?: session('selected_cohort_id');
    
            if (!$selectedCohortId) {
                return response()->json(['message' => 'Cohort ID is required'], 400);
            }
    
            $runningCohort = Cohort::where('id', $selectedCohortId)->first();
    
            if (!$runningCohort) {
                return response()->json(['message' => 'Cohort not found'], 404);
            }
    
            $studentsQuery = $runningCohort->students();
    
            $query = $request->input('query');
    
            try {
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
                    'cohorts' => [$runningCohort], 
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

  
    public function UploudAbsenceReport(Request $request, $absenceId){
        try {
            $absence = Absence::findOrFail($absenceId);
    
            $request->validate([
                'report_file' => 'required|file|max:102400', 
            ]);
    
            $file = $request->file('report_file');
    
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            $publicPath = 'absence_reports/' . $fileName;
            $file->move(public_path('absence_reports'), $fileName);
    
            $absence->update([
                'file_path' => $publicPath,
            ]);
    
            return back()->withSuccess('Report uploaded successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->withError('Absence not found');
        } catch (\Exception $e) {
            return back()->withError('Error uploading report: ' . $e->getMessage());
        }
    }
    
    public function downloadAbsenceReport($absenceId)
    {
        try {
            $absence = Absence::findOrFail($absenceId);
           
            if (!$absence->file_path) {
                return back()->withError('Absence report not found');
            }
            
            // Convert the file path to use the correct directory separator
            $filePath = public_path(str_replace('/', DIRECTORY_SEPARATOR, $absence->file_path));
            // dd($filePath);
            if (!file_exists($filePath)) {
                return back()->withError('File not found');
            }
            
            return response()->download($filePath);
        } catch (ModelNotFoundException $e) {
            return back()->withError('Absence not found');
        } catch (\Exception $e) {
            return back()->withError('Error downloading report: ' . $e->getMessage());
        }
    }
    

}
