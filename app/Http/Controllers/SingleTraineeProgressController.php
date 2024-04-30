<?php

namespace App\Http\Controllers;

use App\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absence;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;
use App\Student;
use App\Technology_Cohort;

class SingleTraineeProgressController extends Controller
{

    public function index(Request $request, $id)
    {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
       
        $cohortID = session('cohort_ID');
        $cohort = Cohort::findOrFail($cohortID);
        $student = Student::find($id);

        // retrieving Absence data ***
        $absencesCount = Absence::where('student_id', $id)->whereNull('file_path')->where('absences_type', 'absent')->get()->count();
        $nonJustifiedAbsencesCount = Absence::where('student_id', $id)->whereNull('file_path')->where('absences_type', 'absent')->count();
        $lateCount = Absence::where('student_id', $id)->whereNull('file_path')->where('absences_type', 'late')->get()->count();
        $nonJustifiedLateCount = Absence::where('student_id', $id)->whereNull('file_path')->where('absences_type', 'late')->count();
        //***
        
        // Retrieve all cohort technologies with their assignments
        $cohortTechnologies = Technology_Cohort::where('cohort_id', $cohortID)->get();
        $technologies = $cohort->technology;
        $technologyNames = [];
        $technologyIds =[];
        foreach ($technologies as $cohortTechnology) {
            $technologyName = $cohortTechnology->technologies_name;
            $technology_id = $cohortTechnology->id;
            $technologyIds[] = $technology_id;
            $technologyNames[] = $technologyName;
        }

        // Retrieve all assignments for the student along with their related topics and technology cohorts
        $studentAssignments = $student->assignment()->with('topic.technologyCohort')->get();
        $assignmentCountsByTechnology = [];
        foreach ($studentAssignments as $assignment) {
            $assignmentTechnologyId = $assignment->topic->technologyCohort->technology_id;

            // Check if the assignment's technology ID matches any of the technology IDs associated with the cohort
            if (in_array($assignmentTechnologyId, $technologyIds)) {
                if (!isset($assignmentCountsByTechnology[$assignmentTechnologyId])) {
                    $assignmentCountsByTechnology[$assignmentTechnologyId] = 1;
                } else {
                    $assignmentCountsByTechnology[$assignmentTechnologyId]++;
                }
            }
        }
        // Extract only the values
        $countValues = array_values($assignmentCountsByTechnology);

        // Retrieve pass submissions for the given assignment ID
        //$passSubmissions = AssignmentSubmission::where('assignment_id', $assignmentId)
                                            //   ->where('status', 'Pass') // Adjust the condition based on your logic
                                            //   ->get();
        // $studentAssignment = Assignment::find($assignmentId);
        // $assignmentTitle=$studentAssignment->assignment_name;

        // fetch submission status, due date, and is late status
        foreach ($studentAssignments as $assignment) {
            $submission = $assignment->assignmentSubmissions()->where('student_id', $student->id)->first();
            $submissionStatus = $submission ? $submission->status : 'No Assignments Assigned';
            $dueDate = $assignment->assignment_due_date; 
            $isLate = $submission ? ($submission->is_late ? 'Late' : 'On Time') : 'Not Submitted';

            // Assign submission status, due date, and is late status to each assignment object
            $assignment->submissionStatus = $submissionStatus;
            $assignment->dueDate = $dueDate;
            $assignment->isLate = $isLate;
        }
        return view('trainer\trainee-progress-details', compact('student', 'absencesCount', 'nonJustifiedAbsencesCount','lateCount', 'nonJustifiedLateCount', 'technologyNames', 'studentAssignments', 'countValues'));
    }
}