<?php

namespace App\Http\Controllers;

use App\Technology_Cohort;
use App\Technology;
use App\StaffCohort;
use App\TechnologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnologyCohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function addToCohort(Request $request, Technology $technology)
    // {
    //     $cohortId = 1;

    //     $existingRecord = Technology_Cohort::where('technology_id', $technology->id)
    //         ->where('cohort_id', $cohortId)
    //         ->first();

    //     if ($existingRecord) {
    //         return redirect()->back()->with('error', 'Technology is already added to the cohort');
    //     }

    //     Technology_Cohort::create([
    //         'technology_id' => $technology->id,
    //         'cohort_id' => $cohortId,
    //         'start_date' => now(),
    //         'end_date' => now(),
    //     ]);

    //     return redirect()->back()->with('success', 'Technology added to the cohort successfully');
    // }

    // public function addToCohort(Request $request, Technology $technology)
    // {
    //     // Retrieve the cohort ID from the session
    //     $cohortId = session('cohort_ID');

    //     // Check if the technology is already added to the cohort
    //     $existingRecord = Technology_Cohort::where('technology_id', $technology->id)
    //         ->where('cohort_id', $cohortId)
    //         ->first();

    //     if ($existingRecord) {
    //         return redirect()->back()->with('error', 'Technology is already added to the cohort');
    //     }

    //     // Create a new record in the junction table
    //     Technology_Cohort::create([
    //         'technology_id' => $technology->id,
    //         'cohort_id' => $cohortId,
    //         'start_date' => now(),
    //         'end_date' => now(),
    //     ]);

    //     return redirect()->back()->with('success', 'Technology added to the cohort successfully');
    // }

    public function addToCohort(Request $request)
    {
        $cohortId = session('cohort_ID');

        // Retrieve the selected technologies from the request
        $selectedTechnologies = $request->input('technologies', []);

        // Check if no technologies are selected
        if (empty($selectedTechnologies)) {
            return redirect()->back()->with('error', 'No technology selected.');
        }

        // Check if any technology is already added to the cohort
        $existingTechnologies = Technology_Cohort::whereIn('technology_id', $selectedTechnologies)
            ->where('cohort_id', $cohortId)
            ->pluck('technology_id')
            ->all();

        if (!empty($existingTechnologies)) {
            $existingTechnologyNames = Technology::whereIn('id', $existingTechnologies)
                ->pluck('technologies_name')
                ->all();

            return redirect()->back()->with('error', 'The following technologies are already added to the cohort: ' . implode(', ', $existingTechnologyNames));
        }

        // Add selected technologies to the cohort
        foreach ($selectedTechnologies as $technologyId) {
            Technology_Cohort::create([
                'technology_id' => $technologyId,
                'cohort_id' => $cohortId,
                'start_date' => now(),
                'end_date' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Selected technologies added to the cohort successfully.');
    }


    public function index()
    {
        //
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
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function show(TechnologyCategory $category)
    {
        // Retrieve cohort ID from session

        $cohortId = session('cohort_ID');

        // Retrieve technologies for the specified category and cohort
        $technologies = Technology::where('technology_category_id', $category->id)
            ->whereHas('technologyCohorts', function ($query) use ($cohortId) {
                $query->where('cohort_id', $cohortId);
            })
            ->get();

        // Pass the data to the view
        return view('technology.technologyRodmap', compact('technologies', 'category', 'cohortId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $ID)
    {

        $technology = Technology_Cohort::findOrFail($ID->ID);
        //    dd($technology);

        return view('technology.editRoadmapTechnology', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $RoadmapTechId = $request->technologyID;
        $technology = technology_Cohort::find($RoadmapTechId);
        $validatedData = $request->validate([
            'technologies_training_period' =>'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $technology->technologies_training_period= $request->technologies_training_period ;
        
        // dd( $technology->technologies_training_period);
        // Update the technology record with validated data
        $technology->update($validatedData);
        $RoadmapTechnology = technology_Cohort::find($RoadmapTechId);
        // $GeneralTechnology = Technology::find($RoadmapTechnology->technology_id);


        // dd($RoadmapTechnology->technology_id);
        // Redirect back with a success message
        return redirect()->route('technology.showInfo', ['technology' => $RoadmapTechnology->technology_id])
            ->with('success', 'Technology updated successfully');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology_Cohort $technology_Cohort)
    {
        //
    }
}
