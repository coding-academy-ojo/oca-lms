<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Skill;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;
use App\Level;
use App\Student;


class TraineesProgressController extends Controller
{

    public function index() {
        // Retrieve data from private methods
        $attendanceOverview = $this->attendanceOverview();
        $lateAssignmentSubmissions = $this->lateAssignmentSubmissions();
        $assignmentAssessment = $this->assignmentAssessment();
        $projectAssessment = $this->projectAssessment();
        $allTrainessOverview = $this->allTrainessOverview();
        $skillsStatus = $this->skillsStatus();


        // Return view with data
        return view('trainer.traineesProgress', compact(
            'attendanceOverview', 'lateAssignmentSubmissions', 'assignmentAssessment', 
            'projectAssessment', 'allTrainessOverview', 'skillsStatus'
        ));    }
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
            'attended_percentage' => intval($attendancePercentage, 2),
            'absent_percentage' => intval($absencePercentage, 2),
            'late_percentage' => intval($latePercentage, 2)
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

        $Submissions= AssignmentSubmission::where('assignment_id', $latestAssignmentId)->get();
        $numberOfSubmissions = AssignmentSubmission::where('assignment_id', $latestAssignmentId)
        ->distinct('student_id')
        ->count('student_id');
        $lateSubmissionsCount = $Submissions->where('is_late', true)->count();
        $onTimeCount = $todaySubmissions->where('is_late', false)->count();
        $passSubmissionsCount = $Submissions->where('status', 'Pass')
        ->where('assignment_id', $latestAssignmentId)
        ->count();

        $notPassSubmissionsCount = $numberOfSubmissions - $passSubmissionsCount;      
        $didNotSubmitCount = $totalStudents - ($lateSubmissionsCount + $onTimeCount);

        // Calculate percentage of All counts 
        $latePercentage = $numberOfSubmissions > 0 ? intval(($lateSubmissionsCount / $numberOfSubmissions) * 100) : 0;
        $onTimePercentage = $numberOfSubmissions > 0 ? intval(($onTimeCount / $numberOfSubmissions) * 100) : 0;
        $didNotSubmitPercentage = $totalStudents > 0 ? intval(($didNotSubmitCount / $totalStudents) * 100) : 0;
        $passSubmissionsPercentage = $numberOfSubmissions > 0 ? intval(($passSubmissionsCount / $numberOfSubmissions) * 100) : 0;
        $notPassSubmissionsPercentage = $numberOfSubmissions > 0 ? 100 - intval(($notPassSubmissionsCount / $numberOfSubmissions) * 100) : 100;
        //$numberOfSubmissions > 0 ? intval(($notPassSubmissionsCount / $numberOfSubmissions) * 100) : 0;

        // dd($notPassSubmissionsPercentage);
        return [
            'totalStudents' => $totalStudents,
            'lateSubmissionsCount' => $lateSubmissionsCount,
            'onTimeCount' => $onTimeCount,
            'didNotSubmitCount' => $didNotSubmitCount,
            'latePercentage' => $latePercentage,
            'onTimePercentage' => $onTimePercentage,
            'didNotSubmitPercentage' => $didNotSubmitPercentage,
            'passSubmissionsCount'=>$passSubmissionsCount,
            'passSubmissionsStatus' => $passSubmissionsPercentage,
            'numberOfSubmissions' => $numberOfSubmissions,
            'notPassSubmissionsCount' => $notPassSubmissionsCount,
            'notPassSubmissionsPercentage' => $notPassSubmissionsPercentage,
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
                'percentageSubmitted' => 0, 
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
        $percentageSubmitted = $numberOfStudentsAssigned > 0 ? ($numberOfStudentsSubmitted / $numberOfStudentsAssigned) * 100 : 0;

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
        return 0;
    }

    private function allTrainessOverview() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        $students = $runningCohort->students;
        // dd($students);
        
    return $students;
    }

    public function showDetails($id){
    // Retrieve the student details based on the provided ID
    $student = Student::find($id);
    // Pass the student details to the view
    return view('trainer.trainee_progress_details', compact('student'));
}
private function skillsStatus() {
    // Fetch all levels
    $levels = Level::all();

    // Fetch all skills and their levels
    $skills = Skill::with('skillLevels')->get();

    $skillsStatus = [];

    foreach ($skills as $skill) {
        $skillLevels = $skill->skillLevels->pluck('level_id')->toArray();
        $levelsStatus = [];

        foreach ($levels as $level) {
            $levelsStatus[] = [
                'level_name' => $level->levels_name,
                'progress' => in_array($level->id, $skillLevels) ? 100 : 0
            ];
        }

        $skillsStatus[] = [
            'skill_name' => $skill->skills_name,
            'levels' => $levelsStatus
        ];
    }

    return $skillsStatus;
}


}

