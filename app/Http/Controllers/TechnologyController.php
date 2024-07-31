<?php

namespace App\Http\Controllers;

use App\Technology;
use App\TechnologyCategory;
use App\Topic;
use App\Technology_Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $category)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId)
    {

        $category = $categoryId;
        return view('technology.createTechnology', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'technology_category_id' => 'required|exists:technology_categories,id',
            'technologies_name' => 'required|string|max:255|unique:technologies',
            'technologies_description' => 'required|string',
            'technologies_resources' => 'required|string',
            'technologies_trainingPeriod' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'technologies_name.unique' => 'The Technology name has already been taken.',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/img'), $imageName); // Store the image in 'public/assets/img'
        } else {
            $imageName = null;
        }

        // Create a new technology instance
        $technology = new Technology;
        $technology->technology_category_id = $validatedData['technology_category_id'];
        $technology->technologies_name = $validatedData['technologies_name'];
        $technology->technologies_description = $validatedData['technologies_description'];
        $technology->technologies_resources = $validatedData['technologies_resources'];
        $technology->technologies_trainingPeriod = $validatedData['technologies_trainingPeriod'];
        $technology->technologies_photo = $imageName;
        $technology->save();

        // Redirect back or to any other route as needed
        return redirect()->route('categories.show', ['category' => $validatedData['technology_category_id']])
            ->with('success', 'Technology added successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)

    {
        return view('technology.technology', compact('technology'));
    }

    // public function showInfo(Technology $technology)
    // {
    //     $technologyCohort = Technology::where('id', $technology->id)->first();

    //     if (!$technologyCohort) {
    //         // Handle case where $technologyCohort is null
    //         return redirect()->route('route.to.redirect')->with('error', 'Technology Cohort not found.');
    //     }

    //     $technologyCohortID = 
    //     $Topics = Topic::where('technology_cohort_id', $$technologyCohort->id)->get();

    //     return view('technology.viewtechnology', compact('technology', 'Topics', 'technologyCohort'));
    // }

    public function showInfo(Technology $technology)
    {
        $technologyCohort = $technology->cohorts()->first();

        if (!$technologyCohort) {
            // Handle case where $technologyCohort is null
            return redirect()->route('route.to.redirect')->with('error', 'Technology Cohort not found.');
        }

        $technologyCohortID = $technologyCohort->pivot->id;

        $Topics = Topic::where('technology_cohort_id', $technologyCohortID)->get();

        return view('technology.viewtechnology', compact('technology', 'Topics', 'technologyCohort'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('technology.editTechnology', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'technologies_name' => 'required|string|max:255',
            'technologies_description' => 'required|string',
            'technologies_resources' => 'required|string',
            'technologies_trainingPeriod' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('path/to/images'), $imageName);
        } else {
            // Keep the existing image if no new one is uploaded
            $imageName = $technology->technologies_photo;
        }

        // Update the technology instance
        $technology->update([
            'technologies_name' => $validatedData['technologies_name'],
            'technologies_description' => $validatedData['technologies_description'],
            'technologies_resources' => $validatedData['technologies_resources'],
            'technologies_trainingPeriod' => $validatedData['technologies_trainingPeriod'],
            'technologies_photo' => $imageName,
        ]);

        // Redirect back or to any other route as needed
        return redirect()->route('technology.showInfo', ['technology' => $technology])->with('success', 'Technology updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        // Delete the records from the pivot table where technology_id matches the technology's id
        DB::table('technology__cohorts')->where('technology_id', $technology->id)->delete();
        
        return redirect()->route('categories.indexCohort')->with('success', 'Technology deleted successfully from Roadmap !');
    }

    public function delete($id)
    {
        // Find the technology by ID and delete it
        $technology = Technology::findOrFail($id);
        $technology->delete();

        return redirect()->route('categories.index')->with('success', 'Technology deleted successfully!');
    }
    
}
