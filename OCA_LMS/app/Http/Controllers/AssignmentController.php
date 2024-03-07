<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Cohort;
use App\Student;
use App\Technology_Cohort;
use App\Topic;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cohortID = session('cohort_ID');
        $query = Assignment::where('cohort_id', $cohortID);
    
        // Filter by technology
        if ($request->has('technology_id')) {
            $query->whereHas('topic', function ($query) use ($request) {
                $query->where('technology_id', $request->technology_id);
            });
        }
    
        // Search by assignment name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('assignment_name', 'like', '%' . $search . '%');
        }
    
        $assignments = $query->get();
    
        // Fetch the list of technologies associated with the current cohort
        // $technologies = TechnologyCohort::where('cohort_id', $cohortID)
        //     ->with('technology')
        //     ->get()
        //     ->pluck('technology');
    
        return view('Assignment.view_assignment', compact('assignments'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cohortID=session('cohort_ID');
        $topics = Topic::all();
        $students = Student::where('cohort_id',$cohortID)->get();
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
        $cohortID=session('cohort_ID');
        $assignment = new Assignment;
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->assignment_attached_file = $request->input('assignment_file');
        $assignment->topic_id = $request->input('topic');
        $assignment->cohort_id = $cohortID;
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

            // Assign students to the assignment
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
        $cohortID=session('cohort_ID');
        $topics = Topic::all();
        $Allstudents = Student::where('cohort_id',$cohortID)->get();
        $assignment = Assignment::find($id);
        // Retrieve all assignments related to the student
        $students = $assignment->student;
        $assignmentStudents = $Allstudents->reject(function ($student) use ($assignment) {
            return $assignment->student->contains('id', $student->id);
        });
        return view('Assignment.edit_assignment', compact('topics', 'assignment', 'students','assignmentStudents'));
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
        $cohortID=session('cohort_ID');
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->assignment_attached_file = $request->input('assignment_file');
        $assignment->topic_id = $request->input('topic');
        $assignment->cohort_id =  $cohortID;
        $assignment->assignment_description = $request->input('description');
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('assignments_files', $fileName);
            $assignment->assignment_attached_file = $fileName;
        }
        if ($request->has('students')) {
            $studentIds = $request->input('students');

            // assign students to the assignment
            $assignment->student()->attach($studentIds);
        }

        $assignment->update();
        return redirect()->route('assignments')->with('success', 'Assignment updated successfully');
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
            ->with('success', 'assignment deleted successfully');
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

    public function removeStudent(Assignment $assignment, Student $student)
    {
        $assignment->student()->detach($student->id);
        return redirect()->back()->with('success', 'Student removed from assignment successfully');
    }
}
