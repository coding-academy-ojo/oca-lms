<?php

namespace App\Http\Controllers;

use App\Assignment;
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
        $assignments=Assignment::all(); 
        return view('Assignment.view_assignment',compact('assignments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics=Topic::all();
        return view('Assignment.create_assignment',compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assignment= new Assignment;
        $assignment->assignment_name = $request->input('name');
        $assignment->assignment_level = $request->input('level');
        $assignment->assignment_due_date = $request->input('due_date');
        $assignment->assignment_attached_file = $request->input('assignment_file');
        $assignment->topic_id = $request->input('topic');
        $assignment->cohort_id = "1";
        $assignment->assignment_description = $request->input('description');
        $assignment->save();

        return redirect()->route('assignments')->with('success', 'Assignment create successfully');

        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);
  
        // Assignment::create($request->all());

 
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
        $topics=Topic::all();
        $assignment = Assignment::find($id);
        return view('Assignment.edit_assignment',compact('topics','assignment'));
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
        // $assignment->assignment_name = $request->input('name');
        // $assignment->assignment_level = $request->input('level');
        // $assignment->assignment_due_date = $request->input('due_date');
        // $assignment->assignment_attached_file = $request->input('assignment_file');
        // $assignment->topic_id = $request->input('topic');
        // $assignment->cohort_id = "1";
        // $assignment->assignment_description = $request->input('description');
        // $assignment->update();

        // return redirect()->route('assignments')->with('success', 'Assignment create successfully');

        $request->validate([
            'name' => 'required|string',
            'level' => 'required|in:easy,medium,advance',
            'due_date' => 'required|date',
            // 'assignment_file' => 'nullable|mimes:pdf',
            'topic' => 'required|exists:topics,id',
            // 'description' => 'nullable|string',
        ]);
  
        $assignment->update($request->all());
        return redirect()->route('assignments')->with('success', 'Assignment create successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */

     public function destroy(Assignment $assignment)
{
    //
}
   
}
