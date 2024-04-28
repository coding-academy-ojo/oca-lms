<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AssignmentSubmission;
use App\Student;

class StudentAssignment extends Controller
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
         // Retrieve all assignments related to the student
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
        $assignment_submision->save();
        return redirect()->route('student.assignments')->with('success', 'Assignment submited successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = Assignment::find($id);

        return view('Assignment.Student_assignment.StudentAssignmentSubmissions', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
