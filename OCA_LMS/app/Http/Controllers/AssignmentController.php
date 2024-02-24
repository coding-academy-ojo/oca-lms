<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Assignment_Student;
use App\Student;
use App\Topic;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::all();
        return view('Assignment.view_assignment', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        $students = Student::all();
        return view('Assignment.create_assignment', compact('topics', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assignment = new Assignment;
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->assignment_attached_file = $request->input('assignment_file');
        $assignment->topic_id = $request->input('topic');
        $assignment->cohort_id = "1";
        $assignment->assignment_description = $request->input('description');
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assignments_files', $fileName);
            $assignment->assignment_attached_file = $fileName;
        }

        $assignment->save();

        // Store assignment-student relationships
        $assignment = Assignment::findOrFail($assignment->id); // Assuming you want to retrieve the assignment by ID

        if ($request->has('students')) {
            $studentIds = $request->input('students');

            // Attach students to the assignment
            $assignment->student()->attach($studentIds);
        }

        return redirect()->route('assignments')->with('success', 'Assignment created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment = Assignment::find($id);

        return view('Assignment.submit_assignment', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topics = Topic::all();
        $students = Student::all();
        $assignment = Assignment::find($id);
        // $selectedStudentIds = [];

        // if ($assignment->students) {
        //     $selectedStudentIds = $assignment->students->pluck('id')->toArray();
        // }

        return view('Assignment.edit_assignment', compact('topics', 'assignment', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->assignment_attached_file = $request->input('assignment_file');
        $assignment->topic_id = $request->input('topic');
        $assignment->cohort_id = "1";
        $assignment->assignment_description = $request->input('description');
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assignments_files', $fileName);
            $assignment->assignment_attached_file = $fileName;
        }
        if ($request->has('students')) {
            $studentIds = $request->input('students');

            // Attach students to the assignment
            $assignment->student()->attach($studentIds);
        }

        $assignment->update();


        return redirect()->route('assignments')->with('success', 'Assignment create successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $assignment = Assignment::find($id);
        $assignment->delete();
        return redirect()->route('assignments')
            ->with('success', 'assignment$assignment deleted successfully');
    }

    public function downloads($filename = null)
    {
        if ($filename === null) {
            return redirect()->back()->with('error', 'File not specified.');
        }
        $path = public_path('assignments_files/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        }
        return redirect()->back()->with('error', 'File not found.');
    }
}
