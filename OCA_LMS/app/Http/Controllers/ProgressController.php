<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use Illuminate\Support\Facades\DB;



class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cohortId = session("cohort_ID");
    
        // Count total absences for the specified cohort
        $totalAbsenceCount = Absence::whereHas('student', function ($query) use ($cohortId) {
            $query->where('cohort_id', $cohortId);
        })->count();
   
        // Count absences for each student in the cohort
        $absenceCounts = Absence::select('student_id', DB::raw('COUNT(*) as count'))
                                 ->whereHas('student', function ($query) use ($cohortId) {
                                     $query->where('cohort_id', $cohortId);
                                 })
                                 ->groupBy('student_id')
                                 ->get();
        return view('trainer.traineesProgress', compact('absenceCounts', 'totalAbsenceCount'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
