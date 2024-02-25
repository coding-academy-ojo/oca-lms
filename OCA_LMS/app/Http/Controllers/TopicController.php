<?php

namespace App\Http\Controllers;

use App\Technology;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics=Topic::all(); 
        return view('Assignment.view_assignment',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies=Technology::all(); 
        return view('Pages.create_topic',compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic= new Topic();
        $topic->topic_name = $request->input('topic_name');
        $topic->technology_id = $request->input('technology_id');
        $topic->save();

        return redirect()->route('assignments')->with('success', 'Assignment create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technologies=Technology::all();
        $topic = Topic::find($id);
        return view('Pages.edit_topic',compact('topic','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->topic_name = $request->input('topic_name');
        $topic->technology_id = $request->input('technology_id');
        $topic->update();

        return redirect()->route('assignments')->with('success', 'Assignment create successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        return redirect()->route('assignments')
            ->with('success', 'assignment$assignment deleted successfully');
    }
}
