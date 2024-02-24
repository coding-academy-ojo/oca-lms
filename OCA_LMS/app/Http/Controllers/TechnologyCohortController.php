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

    public function addToCohort(Request $request, Technology $technology)
    {
        // Derive the cohort ID from the technology's category
        $cohortId = 1;

        // Check if the technology is already added to the cohort
        $existingRecord = Technology_Cohort::where('technology_id', $technology->id)
            ->where('cohort_id', $cohortId)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Technology is already added to the cohort');
        }

        // Create a new record in the junction table
        Technology_Cohort::create([
            'technology_id' => $technology->id,
            'cohort_id' => $cohortId,
            'start_date' => now(),
            'end_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Technology added to the cohort successfully');
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
        session(['cohort_ID' => 1]);
        $cohortId = session('cohort_ID');

        // Retrieve technologies for the specified category and cohort
        $technologies = Technology::where('technology_category_id', $category->id)
            ->whereHas('technologyCohorts', function ($query) use ($cohortId) {
                $query->where('cohort_id', $cohortId);
            })
            ->get();

        // Pass the data to the view
        return view('technology.Technology', compact('technologies', 'category', 'cohortId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology_Cohort $technology_Cohort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology_Cohort  $technology_Cohort
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology_Cohort $technology_Cohort)
    {
        //
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
