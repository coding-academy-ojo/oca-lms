<?php

namespace App\Http\Controllers;

use App\AssignmentFeedback;
use App\AssignmentSubmission;
use Illuminate\Http\Request;

class AssignmentFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cohortID = session('cohort_ID');
    
        // Assuming you have a relationship between Cohort and Assignment
        $assignments = AssignmentSubmission::whereHas('assignment', function ($query) use ($cohortID) {
            $query->where('cohort_id', $cohortID);
        })->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssignmentFeedback  $assignmentFeedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignments = AssignmentSubmission::where('assignment_id',$id)->get();

        return view('Assignment.allAssignmentfeddback', compact('assignments'));
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
