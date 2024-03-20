<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\Assignment;
use App\AssignmetSubmission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TraineeProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cohortId = session("cohort_ID");
    
        $currentDate = Carbon::now()->toDateString(); // Get current date

        // Count total absences for the specified cohort for the current day
        $totalAbsenceCount = Absence::whereHas('student', function ($query) use ($cohortId) {
                $query->where('cohort_id', $cohortId);
            })
            ->whereDate('created_at', $currentDate) // Filter by current date
            ->count();
    
        // Count absences for each student in the cohort for the current day
        $absenceCounts = Absence::select('student_id', DB::raw('COUNT(*) as count'))
            ->whereHas('student', function ($query) use ($cohortId) {
                $query->where('cohort_id', $cohortId);
            })
            ->whereDate('created_at', $currentDate) // Filter by current date
            ->groupBy('student_id')
            ->get();
    
       



         // Retrieve data from private methods

         $LastAssignmentOverview = $this->LastAssignmentOverview();
         return view('trainer.traineesProgress', compact('absenceCounts', 'totalAbsenceCount', 'LastAssignmentOverview'));

    }

    
    private function LastAssignmentOverview() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if ($runningCohort) {
            // If no running cohort is found, return a default set of values
    
            // Get the latest assignment
            $latestAssignment = Assignment::latest()->first();
            $LatestAssignment_id = $latestAssignment->id;
            $totalSubmissions = 0;
            $numberOfStudentsAssigned = $latestAssignment->student()->count();
            dd($numberOfStudentsAssigned);
         // Retrieve all assignments related to the student
         return $numberOfStudentsAssigned ;
           
        }
    
    }
    
    

    
    /**
     * 
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