<?php

namespace App\Http\Controllers;
use App\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Staff;
use Session;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $academyId = null )
    {
        $user = Auth::guard('staff')->user() ?? Auth::guard('students')->user();

        $cohorts = collect();
        $pass_academy_id = collect();
        $canEditCohort = false; 

        if($academyId != null){
            $pass_academy_id =$academyId;
        }
        if ($user instanceof Staff) {
            // Staff user (manager, trainer, or super manager)
            if ($user->role == 'super_manager') {
                $cohorts = Cohort::with('academy')->whereHas('academy', function ($query) use ($academyId) {
                    $query->where('id', $academyId);
                })->get();
                $canEditCohort = true;
            } elseif($user->role == 'manager') {
                // Managers can only view cohorts of academies they are assigned to
                $academies = $user->academies->pluck('id')->toArray();

                if (!in_array($academyId, $academies)) {
                    return redirect()->route('academies')->with('error', 'You are not assigned to this academy.');
                }

                $cohorts = Cohort::where('academy_id', $academyId)->with('academy')->get();
                $canEditCohort = true;
            }elseif ($user->role == 'trainer') {
                $cohorts = $user->cohorts()->with('academy')->get();
                // dd($cohorts);
            }
        } elseif ($user instanceof Student) {
            $cohorts = $user->cohort ? collect([$user->cohort()->with('academy')->first()]) : collect([]);

        }
        // dd($academyId);
        return view('academies.academy-cohorts', compact('cohorts', 'canEditCohort','pass_academy_id'));
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
        // dd($request);
        $request->validate([
            'cohort_name' => 'required|string|max:255',
            'cohort_description' => 'required|string',
            'cohort_start_date' => 'required|date',
            'cohort_end_date' => 'required|date|after_or_equal:cohort_start_date',
            'cohort_donor' => 'required|string',
            'academy_id' => 'required|exists:academies,id',
        ]);

        $cohort = new Cohort();
        $cohort->cohort_name = $request->cohort_name;
        $cohort->cohort_description = $request->cohort_description;
        $cohort->cohort_start_date = $request->cohort_start_date;
        $cohort->cohort_end_date = $request->cohort_end_date;
        $cohort->cohort_donor = $request->cohort_donor;
        $cohort->academy_id = $request->academy_id;

        $cohort->save();

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
        if($id){
            $cohort = cohort::findOrFail($id);
        return view('academies.edit-cohort' , compact('cohort'));
        }else{
            return redirect()->route('academyview')->with('error', 'There is no cohort with that id.');
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
        $academyId = $cohort->academy_id;
        return redirect()->route('academyview', ['academyId' => $academyId])->with('success', 'Cohort updated successfully!');
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
