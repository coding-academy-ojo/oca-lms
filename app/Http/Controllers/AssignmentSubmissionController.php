<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\Student;
use App\Models\Cohort;
use App\Models\Technology;
use Carbon\Carbon;

class AssignmentSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $studentId = session('student_id');
    //     $student = Student::find($studentId);
    //     $cohortId = $student->cohort_id;
    //     // Retrieve all assignments related to the current student 
    //     $assignments = $student->assignment;
    //     // dd($assignments);

    //     return view('Assignment.Student_assignment.assignment_show', compact('assignments'));
    // }

  public function index(Request $request)
{
    // Student from session (as you already use)
    $studentId = session('student_id');
    $student = Student::findOrFail($studentId);

    // Student's cohort
    $cohortID = $student->cohort_id;
    $cohort = Cohort::findOrFail($cohortID);

    // Base query: ONLY assignments in student's cohort
    $query = Assignment::where('cohort_id', $cohortID);

    $search = $request->input('search');

    $assignments = $query
        ->when($search, function ($query, $search) {
            $query->where('assignment_name', 'like', '%' . $search . '%')
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
        ->paginate(10);

    // Ã¢Å“â€¦ SAME logic as staff Ã¢â‚¬â€ technologies only from student's cohort
    $technologies = $cohort->technology;

    return view(
        'Assignment.Student_assignment.assignment_show',
        compact('assignments', 'technologies')
    );
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
        $studentId = session('student_id');
        $assignment_submision = new AssignmentSubmission();
        $assignment_submision->attached_file = $request->input('Assignment_submission');
        $assignment_submision->assignment_id = $request->input('Assignment_ID');
        $assignment_submision->student_id = $studentId;
        $assignment_submision->status = 'not pass';
        $assignment_submision->created_at = Carbon::now();
        $assignmnetId = $request->input('Assignment_ID');
        $Assignment = Assignment::find($assignmnetId);
        $assignmnetdate = $Assignment->assignment_due_date;
        $numberOfSubmissions = AssignmentSubmission::where('assignment_id', $request->input('Assignment_ID'))
            ->where('student_id', $studentId)
            ->count();
        if (now() > $assignmnetdate) {
            if ($numberOfSubmissions < 1) {
                $assignment_submision->is_late = 1;
            } else {
                $assignment_submision->is_late = 0;
            }
        } else {
            $assignment_submision->is_late = 0;
        }


        $assignment_submision->save();
        return redirect()->back()->with('success', 'Assignment submited successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */

    //to view assignment individual and submit the solution 
    public function show($id)
    {
        $studentId = session('student_id');
        $assignment = Assignment::find($id);
        $assignment_submissions = AssignmentSubmission::where('assignment_id', $id)
            ->where('student_id', $studentId)
            ->get();
        // $assignmnet_feedback= AssignmentFeedback::where('assignment_id', $id)->get();

        return view('Assignment.Student_assignment.StudentAssignmentSubmissions', compact('assignment', 'assignment_submissions'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentSubmission  $assignmentSubmission
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
     * @param  \App\Models\AssignmentSubmission  $assignmentSubmission
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
     * @param  \App\Models\AssignmentSubmission  $assignmentSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        //
    }
}

