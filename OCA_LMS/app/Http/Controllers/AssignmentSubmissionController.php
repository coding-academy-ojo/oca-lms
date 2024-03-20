<?php

namespace App\Http\Controllers;

use App\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\AssignmentFeedback;
use App\Student;

class AssignmentSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentId = Auth::id();
        $student = Student::find($studentId);
        // Retrieve all assignments related to the current student 
        $assignments = $student->assignment;
        
        return view('Assignment.Student_assignment.assignment_show', compact('assignments'));
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
        $studentId = Auth::id();
        $assignment_submision = new AssignmentSubmission();
        $assignment_submision->attached_file = $request->input('Assignment_submission');
        $assignment_submision->assignment_id = $request->input('Assignment_ID');
        $assignment_submision->student_id = $studentId;
        $assignment_submision->created_at =now();

        $assignment_submision->save();
        return redirect()->back()->with('success', 'Assignment submited successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */

     //to view assignment individual and submit the solution 
     public function show($id)
     {
         $studentId = Auth::id();
         $assignment = Assignment::find($id);
         $assignment_submissions = AssignmentSubmission::where('assignment_id', $id)
             ->where('student_id', $studentId)
             ->get();
        $assignmnet_feedback= AssignmentFeedback::where('assignment_id', $id)->get();
     
         return view('Assignment.Student_assignment.StudentAssignmentSubmissions', compact('assignment', 'assignment_submissions','assignmnet_feedback'));
     }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assignment)
    {
        $staffId = Auth::id();
        $assignmentSubmission = AssignmentSubmission::findOrFail($assignment);
        $assignmentSubmission->feedback = $request->input('Assignment_feedback');
        $assignmentSubmission->staff_id  = $staffId;
        $assignmentSubmission->updated_at = now();
        $assignmentSubmission->save();
    
        return redirect()->back()->with('success', 'Assignment submitted successfully');
    }

    public function changeStatus($assignment)
    {
        $assignmentSubmission = AssignmentSubmission::findOrFail($assignment);
        $assignmentSubmission->status = 'Pass';
        $assignmentSubmission->update();
    
        return redirect()->back()->with('success', 'Assignment submitted successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        //
    }
}
