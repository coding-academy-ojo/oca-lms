<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Absence;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;


class TraineeProgressController extends Controller
{

    public function index() {
        // Retrieve data from private methods
        $attendanceOverview = $this->attendanceOverview();
        $lateAssignmentSubmissions = $this->lateAssignmentSubmissions();
        $assignmentAssessment = $this->assignmentAssessment();
        $projectAssessment = $this->projectAssessment();

        // Return view with data
        return view('trainer.traineesProgress', compact('attendanceOverview', 'lateAssignmentSubmissions', 'assignmentAssessment', 'projectAssessment'));
    }
    private function attendanceOverview() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if (!$runningCohort) {
            // If no running cohort is found, return a default set of values
            return [
                'cohort_name' => 'N/A',
                'date' => Carbon::now()->format('d-F-Y'),
                'total_students' => 0,
                'attended' => 0,
                'late' => 0,
                'absent' => 0,
                'attended_percentage' => 0,
                'absent_percentage' => 0,
                'late_percentage' => 0
            ];
        }
    
        $students = $runningCohort->students;
        $totalStudents = $students->count();
    
        if ($totalStudents == 0) {
            return [
                'cohort_name' => $runningCohort->cohort_name,
                'date' => Carbon::now()->format('d-F-Y'),
                'total_students' => 0,
                'attended' => 0,
                'late' => 0,
                'absent' => 0,
                'attended_percentage' => 0,
                'absent_percentage' => 0,
                'late_percentage' => 0
            ];
        }
    
        $todayAbsences = $students->flatMap(function($student) {
            return $student->absences()->where('absences_date', Carbon::today()->toDateString())->get();
        });
    
        $lateCount = $todayAbsences->where('absences_type', 'late')->count();
        $absentCount = $todayAbsences->where('absences_type', 'absent')->count();
        $attended = $totalStudents - $lateCount - $absentCount;
    
        // Avoid division by zero by checking if $totalStudents is zero
        $attendancePercentage = $totalStudents > 0 ? ($attended / $totalStudents) * 100 : 0;
        $absencePercentage = $totalStudents > 0 ? ($absentCount / $totalStudents) * 100 : 0;
        $latePercentage = $totalStudents > 0 ? ($lateCount / $totalStudents) * 100 : 0;
    
        return [
            'cohort_name' => $runningCohort->cohort_name,
            'date' => Carbon::now()->format('d-F-Y'),
            'total_students' => $totalStudents,
            'attended' => $attended,
            'late' => $lateCount,
            'absent' => $absentCount,
            'attended_percentage' => round($attendancePercentage, 2),
            'absent_percentage' => round($absencePercentage, 2),
            'late_percentage' => round($latePercentage, 2)
        ];
    }
    
    
    private function lateAssignmentSubmissions() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        
        if (!$runningCohort) {
            // No running cohort found for the staff
            return [
                'message' => 'No running cohort found.',
                'totalStudents' => 0,
                'lateSubmissionsCount' => 0,
                'onTimeCount' => 0,
                'didNotSubmitCount' => 0,
                'latePercentage' => 0,
                'onTimePercentage' => 0,
                'didNotSubmitPercentage' => 0,
            ];
        }
    
        $today = now()->toDateString();
        $totalStudents = $runningCohort->students->count();

        // Get the latest assignment
        $latestAssignment = Assignment::latest()->first();
        $latestAssignmentId = $latestAssignment->id;
    
        $todaySubmissions = AssignmentSubmission::whereHas('assignment', function ($query) use ($runningCohort) {
            $query->where('cohort_id', $runningCohort->id);
        })->whereDate('created_at', '=', $today)->get();

        $numberOfSubmissions= AssignmentSubmission::where('assignment_id', $latestAssignmentId);


    
        $lateSubmissionsCount = $todaySubmissions->where('is_late', true)->count();
        $onTimeCount = $todaySubmissions->where('is_late', false)->count();

        $passSubmissionsCount = $numberOfSubmissions->where('status', 'Pass')->count();
        
        $didNotSubmitCount = $totalStudents - ($lateSubmissionsCount + $onTimeCount);
        
        $latePercentage = $totalStudents > 0 ? round(($lateSubmissionsCount / $totalStudents) * 100, 2) : 0;
    
        $onTimePercentage = $totalStudents > 0 ? round(($onTimeCount / $totalStudents) * 100, 2) : 0;
    
        $didNotSubmitPercentage = $totalStudents > 0 ? round(($didNotSubmitCount / $totalStudents) * 100, 2) : 0;
        // Calculate the percentage of "Pass" submissions
    $passSubmissionsPercentage = $totalStudents > 0 ? round(($passSubmissionsCount / $numberOfSubmissions->count()) * 100, 2) : 0;
    
        return [
            'totalStudents' => $totalStudents,
            'lateSubmissionsCount' => $lateSubmissionsCount,
            'onTimeCount' => $onTimeCount,
            'didNotSubmitCount' => $didNotSubmitCount,
            'latePercentage' => $latePercentage,
            'onTimePercentage' => $onTimePercentage,
            'didNotSubmitPercentage' => $didNotSubmitPercentage,
            '
            '=>$passSubmissionsCount,
            'passSubmissionsStatus' => $passSubmissionsPercentage,
        ];
    }
       
    private function assignmentAssessment() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        
        if (!$runningCohort) {
            // No running cohort found for the staff
            return [
                'message' => 'No running cohort found.',
                'totalStudents' => 0,
                'percentageSubmitted' => 0, // Change here
            ];
        }
    
        // Get the latest assignment
        $latestAssignment = Assignment::latest()->first();
        $latestAssignmentId = $latestAssignment->id;
        $latestAssignmentTitle=$latestAssignment->assignment_name;
        
        // Get the number of students assigned to the latest assignment
        $numberOfStudentsAssigned = $latestAssignment->student()->count();
    
        // Get the number of students who submitted the latest assignment
        $numberOfStudentsSubmitted = AssignmentSubmission::where('assignment_id', $latestAssignmentId)
            ->distinct('student_id')
            ->count('student_id');
        
        // Calculate the percentage of students who submitted their assignment
        $percentageSubmitted = ($numberOfStudentsSubmitted / $numberOfStudentsAssigned) * 100;

    $numberOfStudentsNotSubmitted = $numberOfStudentsAssigned- $numberOfStudentsSubmitted;
        return [
            'numberOfStudentsAssigned' => $numberOfStudentsAssigned,
            'percentageSubmitted' => $percentageSubmitted,
            'numberOfStudentsSubmitted' => $numberOfStudentsSubmitted,
            'latestAssignmentTitle' => $latestAssignmentTitle,
            'numberOfStudentsNotSubmitted' => $numberOfStudentsNotSubmitted,
            'latestAssignmentId' => $latestAssignmentId,
        ];
    }
    
    private function projectAssessment() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        
    
    }
    
    
}