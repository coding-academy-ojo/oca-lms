<?php

namespace App\Http\Controllers;

use App\Skill;
use App\SkillLevel;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch skills
        $skills = Skill::all();

        // Fetch skill levels
        $skillLevels = SkillLevel::all();

        return view('skillsFramework.skillsFramework', compact('skills', 'skillLevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skillsFramework.addSkillsFramework');
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
            'name' => 'required|string|max:255',
        ]);

        // Create Skill
        Skill::create([
            'skills_name' => $request->name,
        ]);

        return redirect()->route('skillsFramework')->with('success', 'Skill Framework created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $skill = Skill::findOrFail($id);
        // dd($skill);
        return view('skillsFramework.editSkillsFramework', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'skills_name' => 'required|string|max:255', 
        ]);

        // Find the skill by ID
        $skill = Skill::findOrFail($id);

        // Update the skill name
        $skill->skills_name = $request->input('skills_name'); // Assuming 'skills_name' is the input field name

        // Save the updated skill
        $skill->save();

        // Redirect back to the edit page with a success message
        return redirect()->route('skillsFramework', ['id' => $skill->id])->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }

    
}
