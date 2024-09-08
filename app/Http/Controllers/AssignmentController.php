<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;
use App\Student;
use App\Technology;
use App\Technology_Cohort;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cohort = Cohort::findOrFail($cohortID);
        $query = Assignment::where('cohort_id', $cohortID);
        $search = $request->input('search');
    
        $assignments = $query->when($search, function ($query, $search) {
                return $query->where('assignment_name', 'like', '%' . $search . '%')
                            ->orWhereHas('topic', function ($topicQuery) use ($search) {
                                $topicQuery->where('topic_name', 'like', '%' . $search . '%');
                            });
            })
            ->when($request->filled('technology_id'), function ($query) use ($request) {
                $query->whereHas('topic', function ($topicQuery) use ($request) {
                    $topicQuery->whereHas('technologyCohort', function ($technologyCohortQuery) use ($request) {
                        $technologyCohortQuery->where('technology_id', $request->technology_id);
                    });
                });
            })
            ->paginate(5);
    
        //retrive all technologies related to current cohort
        $technologies = $cohort->technology;
    
        return view('Assignment.view_assignment', compact('assignments', 'technologies'));
    }
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cohortID=session('cohort_ID');
        $topics = Topic::whereHas('technologyCohort', function ($query) use ($cohortID) {
            $query->where('cohort_id', $cohortID);
        })->get();
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
        $trainerId = Auth::id();
        $cohortID = session('cohort_ID');
        
        $assignment = new Assignment;
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->topic_id = $request->input('topic');
        $assignment->created_at = now();
        $assignment->cohort_id = $cohortID;
        $assignment->staff_id = $trainerId;
        $assignment->assignment_description = $request->input('description');
    
        // Upload and attach assignment file if provided
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
            
            // If "All students" is selected, get all student IDs in the cohort
            if (in_array('', $studentIds)) {
                $studentIds = Student::where('cohort_id', $cohortID)->pluck('id')->toArray();
            }
            
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
    // public function show($id)
    // {
    //     $assignment = Assignment::find($id);
    //     $cohortID = session('cohort_ID');
        
        
    //     $AssignmentSubmission = AssignmentSubmission::where('assignment_id',$id)->get();


    //     return view('Assignment.submit_assignment', compact('assignment','AssignmentSubmission'));
    // }

    public function show(Request $request, $id)
    {
        $cohortID = session('cohort_ID');
        $assignment = Assignment::where('cohort_id', $cohortID)->findOrFail($id); 
        // $query = Assignment::where('cohort_id', $cohortID);
        $search = $request->input('search');
        $AssignmentSubmission = AssignmentSubmission::where('assignment_id', $id)
            ->when($search, function ($assignment, $search) {
                return $assignment->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('en_first_name', 'like', '%' . $search . '%')
                                 ->orWhere('en_last_name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(5);
    
        return view('Assignment.submit_assignment', compact('assignment', 'AssignmentSubmission'));
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
        $topics = Topic::whereHas('technologyCohort', function ($query) use ($cohortID) {
            $query->where('cohort_id', $cohortID);
        })->get();
        $Allstudents = Student::where('cohort_id',$cohortID)->get();
        $assignment = Assignment::find($id);
        // Retrieve all assignments related to the student
        $students = $assignment->student;
        $assignmentStudents = $Allstudents->reject(function ($student) use ($assignment) {
            return $assignment->student->contains('id', $student->id);
        });
        // Check if all students are already assigned
        $isAllAssigned = $assignmentStudents->isEmpty();
    
        return view('Assignment.edit_assignment', compact('topics', 'assignment', 'students', 'assignmentStudents', 'isAllAssigned'));
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
    $TrainertId = Auth::id();
    $cohortID = session('cohort_ID');
    $assignment->assignment_name = $request->input('name');
    $assignment->assignment_level = $request->input('level');
    $assignment->assignment_due_date = $request->input('due_date');
    $assignment->topic_id = $request->input('topic');
    $assignment->cohort_id = $cohortID;
    $assignment->staff_id = $TrainertId;
    $assignment->updated_at = now();
    $assignment->assignment_description = $request->input('description');

    if ($request->hasFile('assignment_file')) {
        $file = $request->file('assignment_file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('assignments_files', $fileName);
        $assignment->assignment_attached_file = $fileName;
    }

    $assignment->save();

    if ($request->has('students')) {
        $studentIds = $request->input('students');
        
        // If "All students" is selected, get all student IDs in the cohort
        if (in_array('', $studentIds)) {
            $allStudentIds = Student::where('cohort_id', $cohortID)->pluck('id')->toArray();
            $alreadyAssignedStudentIds = $assignment->student->pluck('id')->toArray();

            // Only attach students who haven't been assigned yet
            $studentIds = array_diff($allStudentIds, $alreadyAssignedStudentIds);
        }

        // Attach new students to the assignment
        if (!empty($studentIds)) {
            $assignment->student()->attach($studentIds);
        }
    }

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
