<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Absence;
use App\AssignmentSubmission;

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
        
        return view('student.dashboard', compact('student', 'justifiedAbsencesCount', 'nonJustifiedAbsencesCount', 'justifiedLateCount', 'nonJustifiedLateCount', 'assignmentsStatus'));
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
    
    
    
    
    
    
}
    

