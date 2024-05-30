<?php

namespace App\Http\Controllers;

use App\SkillLevel;
use App\Skill;
use Illuminate\Http\Request;

class SkillLevelController extends Controller
{
    public function edit($id)
    {
        // dd(1);
        $skillLevels = SkillLevel::where('skill_id', $id)->get();

        // Find the skill itself
        $skill = Skill::findOrFail($id);

        // Load the 'level' relationship to avoid "Trying to get property 'level' of non-object" error
        $skillLevels->load('level');

        // dd( $skillLevels);
        return view('skillsFramework.editSkillsLevel', compact('skillLevels', 'skill'));
    }


    public function update(Request $request, $id)
    {

        // dd(1);
        // Validate the request data
        $request->validate([
            'level' => 'required|string|', // Adjust validation rules as needed
        ]);



        // Find the skill level by its ID
        $skillLevel = SkillLevel::findOrFail($id);
        // dd($skillLevel);

        // Update the skill level's description
        $skillLevel->update([
            'skillLevels_description' => $request->level,
        ]);

        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Skill level updated successfully.');
        return redirect()->route('skillsFramework', ['id' => $id])->with('success', 'Skill updated successfully!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'level' => 'required|string',
        ]);

        SkillLevel::create([
            'skill_id' => $request->input('skill_id'),
            'level' => $request->input('level'),
            'skillLevels_description' => $request->input('level_description'),
        ]);

        return redirect()->route('editSkillLevel', ['id' => $request->input('skill_id')])
            ->with('success', 'Skill level added successfully!');
    }
}
