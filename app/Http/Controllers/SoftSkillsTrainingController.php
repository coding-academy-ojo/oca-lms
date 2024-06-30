<?php

namespace App\Http\Controllers;

use App\SoftSkillsTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftSkillsTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        $runningCohorts = $staff->cohorts()->where('cohort_end_date', '>', now())->get();
        
        if ($runningCohorts->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'No running cohorts found for the trainer');
        }

        $softSkills = SoftSkillsTraining::whereIn('cohort_id', $runningCohorts->pluck('id'))->get();
        return view('soft_skills.index', compact('softSkills', 'runningCohorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff = Auth::guard('staff')->user();
        $runningCohorts = $staff->cohorts()->where('cohort_end_date', '>', now())->get();
        
        return view('soft-skills.create', compact('runningCohorts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'trainer' => 'required',
            'date' => 'required|date',
            'satisfaction' => 'nullable|numeric|min:0|max:100',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);
    
        SoftSkillsTraining::create($request->all());
        return redirect()->route('soft-skills.index')->with('success', 'Soft Skills Training created successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\SoftSkillsTraining  $softSkillsTraining
     * @return \Illuminate\Http\Response
     */
    public function show(SoftSkillsTraining $softSkillsTraining)
    {
        return view('soft-skills.show', compact('softSkillsTraining'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SoftSkillsTraining  $softSkillsTraining
     * @return \Illuminate\Http\Response
     */
    public function edit(SoftSkillsTraining $softSkillsTraining)
    {
        $staff = Auth::guard('staff')->user();
        $runningCohorts = $staff->cohorts()->where('cohort_end_date', '>', now())->get();

        abort_if(!$runningCohorts->pluck('id')->contains($softSkillsTraining->cohort_id), 403);

       
        return view('soft_skills.edit', compact('softSkillsTraining', 'runningCohorts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SoftSkillsTraining  $softSkillsTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoftSkillsTraining $softSkillsTraining)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'trainer' => 'required',
            'date' => 'required|date',
            'satisfaction' => 'nullable|numeric|min:0|max:100',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);
    
        $softSkillsTraining->update($request->all());
        return redirect()->route('soft-skills.index')->with('success', 'Soft Skills Training updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SoftSkillsTraining  $softSkillsTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoftSkillsTraining $softSkillsTraining)
    {
        $softSkillsTraining->delete();
        return redirect()->route('soft-skills.index')->with('success','Soft Skills Training deleted successfully');
    }
}
