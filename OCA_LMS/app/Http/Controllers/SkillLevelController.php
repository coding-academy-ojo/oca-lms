<?php

namespace App\Http\Controllers;

use App\SkillLevel;
use App\Skill;
use Illuminate\Http\Request;

class SkillLevelController extends Controller
{
    public function edit($id)
    {
        $skillLevels = SkillLevel::where('skill_id', $id)->get();

        // Find the skill itself
        $skill = Skill::findOrFail($id);
    
        // Load the 'level' relationship to avoid "Trying to get property 'level' of non-object" error
        $skillLevels->load('level');
    
        return view('skillsFramework.editSkillsLevel', compact('skillLevels', 'skill'));
    }


    public function update(Request $request, $id)
    {

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
        return redirect()->back()->with('success', 'Skill level updated successfully.');
        
    }

}
