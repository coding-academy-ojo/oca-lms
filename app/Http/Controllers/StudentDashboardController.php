<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Absence;
use App\AssignmentSubmission;
use App\Student; 

use App\TraineeSkillsProgress;
use App\Project;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('students')->user();
        $justifiedAbsencesCount = $this->countJustifiedAbsences($student->id);
        $nonJustifiedAbsencesCount = $this->countNonJustifiedAbsences($student->id);
        $justifiedLateCount = $this->countJustifiedLate($student->id);
        $nonJustifiedLateCount = $this->countNonJustifiedLate($student->id);
        $assignmentsStatus = $this->getAssignmentsStatus($student->id);
        $studentProjects = $this->getStudentProjects($student->id);
        
        return view('student.dashboard', compact('student', 'justifiedAbsencesCount', 'nonJustifiedAbsencesCount', 'justifiedLateCount', 'nonJustifiedLateCount', 'assignmentsStatus', 'studentProjects'));
    }

    private function countJustifiedAbsences($studentId)
    {
        return Absence::where('student_id', $studentId)
                      ->whereNotNull('file_path')
                      ->where('absences_type', 'absent')
                      ->count();
    }

    private function countNonJustifiedAbsences($studentId)
    {
        return Absence::where('student_id', $studentId)
                      ->whereNull('file_path')
                      ->where('absences_type', 'absent')
                      ->count();
    }

    private function countJustifiedLate($studentId)
    {
        return Absence::where('student_id', $studentId)
                      ->whereNotNull('file_path')
                      ->where('absences_type', 'late')
                      ->count();
    }

    private function countNonJustifiedLate($studentId)
    {
        return Absence::where('student_id', $studentId)
                      ->whereNull('file_path')
                      ->where('absences_type', 'late')
                      ->count();
    }



    private function getAssignmentsStatus($studentId)
    {
        // Fetch all assignment submissions for the student with their assignment names
        $assignmentsStatus = AssignmentSubmission::join('assignments', 'assignment_submissions.assignment_id', '=', 'assignments.id')
            ->where('assignment_submissions.student_id', $studentId)
            ->select('assignments.assignment_name', 'assignment_submissions.status')
            ->get()
            ->map(function ($submission) {
                $status = ($submission->status === 'pass') ? 'Passed' : 'Not Passed';
    
                return [
                    'assignment_name' => $submission->assignment_name,
                    'status' => $status
                ];
            });
    // dd($assignmentsStatus);
        return $assignmentsStatus;
    }

    private function getStudentProjects($studentId) {
        $student = Student::find($studentId);
        $cohortId = $student->cohort_id;

        $projects = Project::where('cohort_id', $cohortId)->get();

        return $projects->map(function($project) use ($studentId) {
            $traineeProgress = TraineeSkillsProgress::where('student_id', $studentId)
                ->where('project_id', $project->id)
                ->first();

            return [
                'due_date' => $project->project_delivery_date,
                'project_name' => $project->project_name,
                'status' => $traineeProgress ? ($traineeProgress->project_status == 1 ? 'Passed' : 'Not Passed') : '',
                'submission_date' => $traineeProgress && $traineeProgress->created_at ? $traineeProgress->created_at->format('d/m/Y') : 'N/A', // Format the date as needed
            ];
        });
    }
    
    
    
    
    
    
}
    

