<?php

namespace App\Http\Controllers;
use App\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Academy;
use App\Staff;
use Session;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $academyId = null)
    {
        $user = Auth::guard('staff')->user() ?? Auth::guard('students')->user();

        $academies = collect();
        $canEditCohort = false;

        if ($user instanceof Staff) {
            // Staff user (manager, trainer, or super manager)
            if ($user->role == 'super_manager') {
                $academies = Academy::with('cohorts', 'managers')->get();
                $canEditCohort = true;
            } elseif ($user->role == 'manager') {
                // Managers can only view cohorts of academies they are assigned to
                $academyIds = $user->academies->pluck('id')->toArray();
                $academies = Academy::with('cohorts', 'managers')->whereIn('id', $academyIds)->get();
                $canEditCohort = true;
            }  elseif ($user->role == 'trainer') {
                $academyIds = $user->academies->pluck('id')->toArray();
                $academies = Academy::with(['cohorts' => function($query) use ($user) {
                    $query->whereHas('staff', function ($query) use ($user) {
                        $query->where('staff_id', $user->id);
                    });
                }])->whereIn('id', $academyIds)->get();
                // dd($academies);
            }
        } elseif ($user instanceof Student) {
            $cohorts = $user->cohort ? collect([$user->cohort()->with('academy')->first()]) : collect([]);
        }

        return view('academies.academy-cohorts', compact('academies', 'canEditCohort'));
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
        $request->validate([
            'cohort_name' => 'required|string|max:255',
            'cohort_description' => 'required|string',
            'cohort_start_date' => 'required|date',
            'cohort_end_date' => 'required|date|after_or_equal:cohort_start_date',
            'cohort_donor' => 'required|string',
            'academy_id' => 'required|exists:academies,id',
            'trainers' => 'nullable|array', 
            'trainers.*' => 'exists:staff,id',
        ]);
    
        // Create a new cohort instance
        $cohort = new Cohort();
        $cohort->cohort_name = $request->cohort_name;
        $cohort->cohort_description = $request->cohort_description;
        $cohort->cohort_start_date = $request->cohort_start_date;
        $cohort->cohort_end_date = $request->cohort_end_date;
        $cohort->cohort_donor = $request->cohort_donor;
        $cohort->academy_id = $request->academy_id;
    
        // Save the cohort details
        $cohort->save();
    
        // Assign trainers to the cohort if provided
        if ($request->has('trainers')) {
            $cohort->staff()->sync($request->trainers);
        }
    
        return redirect()->back()->with('success', 'Cohort created successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cohortId)
    {
        $cohort = Cohort::findOrFail($cohortId); 
        
        session(['cohort_ID' => $cohortId]);
        // dd(session('cohort_ID'));
        return view('academies.view-cohort', compact('cohort'));
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::guard('staff')->user();

        if ($id) {
            $cohort = Cohort::findOrFail($id);

            // Check if the user is a manager and retrieve trainers from the same academies
            if ($user->role == 'manager') {
                $academyIds = $user->academies->pluck('id')->toArray();

                // Retrieve all trainers for the academies the manager is assigned to
                $trainers = Staff::whereHas('academies', function ($query) use ($academyIds) {
                    $query->whereIn('academies.id', $academyIds);
                })->where('role', 'trainer')->get();

                return view('academies.edit-cohort', compact('cohort', 'trainers'));
            } else {
                return view('academies.edit-cohort', compact('cohort'));
            }
        } else {
            return redirect()->route('academies')->with('error', 'There is no cohort with that id.');
        }
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
        $rules = [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'name' => 'nullable|string',
            'cohort_donor' => 'nullable|string',
            'description' => 'nullable|string',
            'trainers' => 'nullable|array', // For assigning multiple trainers
            'trainers.*' => 'exists:staff,id', // Ensure each trainer exists
        ];
    
        $validatedData = $request->validate($rules);
    
        $cohort = Cohort::findOrFail($id);
    
        // Update the cohort only if the inputs are not null
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                switch ($key) {
                    case 'name':
                        $cohort->cohort_name = $value;
                        break;
                    case 'cohort_donor':
                        $cohort->cohort_donor = $value;
                        break;
                    case 'start_date':
                        $cohort->cohort_start_date = $value;
                        break;
                    case 'end_date':
                        $cohort->cohort_end_date = $value;
                        break;
                    case 'description':
                        $cohort->cohort_description = $value;
                        break;
                }
            }
        }
    
        $cohort->save();
    
        // Ensure the authenticated manager is always included in the trainers list
        $trainers = $request->has('trainers') ? $request->trainers : [];
        $user = Auth::guard('staff')->user();
        if ($user && $user->role == 'manager') {
            $trainers[] = $user->id;
        }
        $cohort->staff()->sync($trainers);
    
        $academyId = $cohort->academy_id;
        return redirect()->route('academies', ['academyId' => $academyId])->with('success', 'Cohort updated successfully!');
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
