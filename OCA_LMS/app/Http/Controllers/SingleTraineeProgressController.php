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
        //getting cohort id form session
        $cohortID = session('cohort_ID');
        $cohort = Cohort::findOrFail($cohortID);

        // Retrieve the student details based on the provided ID
        $student = Student::find($id);
        // Retrieve absence records for the student
        $absencesCount = Absence::where('student_id', $id)->where('absences_type', 'absent')->get()->count();
            // Retrieve late status for the student
        $lateCount = Absence::where('student_id', $id)->where('absences_type', 'late')->get()->count();
        // Retrieve all cohort technologies with their assignments
        $cohortTechnologies = Technology_Cohort::where('cohort_id', $cohortID)->get();
        $technologies = $cohort->technology;
//to store technology names and ids
        $technologyNames = [];
        $technologyIds =[];
        // Loop through the cohort technologies
        foreach ($technologies as $cohortTechnology) {
            // Get the technology name
            $technologyName = $cohortTechnology->technologies_name;
            //Store the technology name in the array
            $technology_id = $cohortTechnology->id;
            $technologyIds[] = $technology_id;
            $technologyNames[] = $technologyName;
        }

/////////////////////////////////////////////////////////////////////////////////   
// Retrieve all assignments for the student along with their related topics and technology cohorts
$studentAssignments = $student->assignment()->with('topic.technologyCohort')->get();

// Initialize an empty array to store the count of assignments for each technology ID
$assignmentCountsByTechnology = [];

// Loop through the assignments
foreach ($studentAssignments as $assignment) {
    // Get the technology ID for the assignment
    $assignmentTechnologyId = $assignment->topic->technologyCohort->technology_id;
    // Get the technology name for the assignment
    //$technologyName = $assignment->topic->technologyCohort->technology->name;
    // Check if the assignment's technology ID matches any of the technology IDs associated with the cohort
    if (in_array($assignmentTechnologyId, $technologyIds)) {
        // Increment the count of assignments for the respective technology ID
        if (!isset($assignmentCountsByTechnology[$assignmentTechnologyId])) {
            $assignmentCountsByTechnology[$assignmentTechnologyId] = 1;
        } else {
            $assignmentCountsByTechnology[$assignmentTechnologyId]++;
        }
    }
}

// Extract only the values (count of assignments) without keys (technology IDs)
$countValues = array_values($assignmentCountsByTechnology);

// Retrieve pass submissions for the given assignment ID
//$passSubmissions = AssignmentSubmission::where('assignment_id', $assignmentId)
                                    //   ->where('status', 'Pass') // Adjust the condition based on your logic
                                    //   ->get();
// $studentAssignment = Assignment::find($assignmentId);
// $assignmentTitle=$studentAssignment->assignment_name;

// Loop through the assignments to fetch submission status, due date, and is late status
foreach ($studentAssignments as $assignment) {
    // Fetch the submission status for the assignment
    $submission = $assignment->assignmentSubmissions()->where('student_id', $student->id)->first();

    $submissionStatus = $submission->status; // Assuming 'Passed' if submission exists, 'Not Submitted' otherwise
    // Fetch the due date for the assignment
    $dueDate = $assignment->assignment_due_date; // Assuming 'due_date' is the field name in the assignments table

   // Fetch the "is late" status for the assignment submission
  $isLate = $submission ? ($submission->is_late ? 'Late' : 'On Time') : 'Not Submitted';

    // Assign submission status, due date, and is late status to each assignment object
    $assignment->submissionStatus = $submissionStatus;
    $assignment->dueDate = $dueDate;
    $assignment->isLate = $isLate;
}

       
        // Pass the student details to the view
        return view('trainer\trainee-progress-details', compact('student', 'absencesCount', 'lateCount', 'technologyNames', 'studentAssignments', 'countValues'));
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   public function show(Trainee $trainee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainee $trainee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainee $trainee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        //
    }
}