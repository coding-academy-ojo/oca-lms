<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\AssignmentFeedback;
use App\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cohortID = session('cohort_ID');
        
        $query = AssignmentSubmission::query()
            ->whereHas('assignment', function ($query) use ($cohortID) {
                $query->where('cohort_id', $cohortID);
            });
    
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($query) use ($search) {
                    $query->whereHas('assignment', function ($query) use ($search) {
                        $query->where('assignment_name', 'like', "%$search%");
                    })->orWhereHas('student', function ($query) use ($search) {
                        $query->where('en_first_name', 'like', "%$search%")
                            ->orWhere('en_second_name', 'like', "%$search%")
                            ->orWhere('en_last_name', 'like', "%$search%")
                            ->orWhere('ar_first_name', 'like', "%$search%")
                            ->orWhere('ar_second_name', 'like', "%$search%")
                            ->orWhere('ar_last_name', 'like', "%$search%");
                    });
                });
            }
        
            $assignments = $query->paginate(5);
    
        $assignments = $query->paginate(5);
        
        return view('Assignment.allAssignmentfeddback', compact('assignments'));
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
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignmentFeedback  $assignmentFeedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignments = AssignmentSubmission::where('assignment_id',$id)->paginate(5);;

        return view('Assignment.allAssignmentfeddback', compact('assignments'));
    }
    

    public function submissionfedback($id , $studentId)
    {
        $assignment = Assignment::find($id);
        $assignment_submissions = AssignmentSubmission::where('assignment_id', $id)
            ->where('student_id', $studentId)
            ->get();
            $lastSubmission = $assignment_submissions->last();
            $lastSubmissionID = $lastSubmission->id;
        return view('Assignment.Student_assignment.StudentAssignmentSubmissions', compact('assignment', 'assignment_submissions','lastSubmissionID'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignmentFeedback  $assignmentFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentFeedback $assignmentFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignmentFeedback  $assignmentFeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignmentFeedback $assignmentFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignmentFeedback  $assignmentFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentFeedback $assignmentFeedback)
    {
        //
    }
}
