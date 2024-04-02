<?php

namespace App\Http\Controllers;

use App\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absence;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;
use App\Student;
use App\Technology_Cohort;

class SingleTraineeProgressController extends Controller
{

    public function index(Request $request, $id)
    {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        $cohortID = session('cohort_ID');
         $cohort = Cohort::findOrFail($cohortID);

        // Retrieve the student details based on the provided ID
        $student = Student::find($id);
        // Retrieve absence records for the student
        $absencesCount = Absence::where('student_id', $id)->where('absences_type', 'absent')->get()->count();
            // Retrieve late status for the student
        $lateCount = Absence::where('student_id', $id)->where('absences_type', 'late')->get()->count();
        // Retrieve all cohort technologies with their assignments
        $cohortTechnologies = Technology_Cohort::where('cohort_id', $cohortID)->get();
        $technologies = $cohort->technology;

        $technologyNames = [];
        // Loop through the cohort technologies
        foreach ($technologies as $cohortTechnology) {
            // Get the technology name
            $technologyName = $cohortTechnology->technologies_name;
            //Store the technology name in the array
            $technologyNames[] = $technologyName;
           
        }
//dd($technologyNames);

       
       
        // Pass the student details to the view
        return view('trainer\trainee-progress-details', compact('student', 'absencesCount', 'lateCount', 'technologyNames'));
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show(Trainee $trainee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainee $trainee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainee $trainee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        //
    }
}