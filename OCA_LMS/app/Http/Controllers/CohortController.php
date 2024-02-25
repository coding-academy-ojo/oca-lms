<?php

namespace App\Http\Controllers;
use App\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Staff;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $academyId)
    {
        $user = Auth::guard('staff')->user() ?? Auth::guard('students')->user();

        $cohorts = collect();
        $canEditCohort = false; // Default to false

        if ($user instanceof Staff) {
            // Staff user (manager, trainer, or super manager)
            if ($user->role == 'super_manager') {
                // Super Manager can view all cohorts and edit them
                $cohorts = Cohort::with('academy')->get();
                $canEditCohort = true;
            } else {
                // Managers can only view cohorts of academies they are assigned to
                $academies = $user->academies->pluck('id')->toArray();

                if (!in_array($academyId, $academies)) {
                    // If not assigned redirect to the academies view with an error message
                    return redirect()->route('academies.index')->with('error', 'You are not assigned to this academy.');
                }

                $cohorts = Cohort::where('academy_id', $academyId)->with('academy')->get();
                $canEditCohort = true;
            }
        } elseif ($user instanceof Student) {
            // Student user
            $studentAcademyId = $user->academy_id;
            if ($studentAcademyId != $academyId) {
                // If the student's academy does not match the requested academy, redirect with an error message
                return redirect()->route('academies.index')->with('error', 'You are not enrolled in this academy.');
            }

            // Retrieve the cohorts based on the student's academy
            $cohorts = Cohort::where('academy_id', $studentAcademyId)->with('academy')->get();
           
        }
        return view('academies.academy-cohorts', compact('cohorts', 'canEditCohort'));
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
        return view('academies.edit-cohort');
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