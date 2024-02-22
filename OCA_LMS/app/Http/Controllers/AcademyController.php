<?php

namespace App\Http\Controllers;

use App\Academy;
use App\Staff;
use App\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
public function index()
{
    $user = Auth::guard('staff')->user() ?? Auth::guard('students')->user();
    $isSuperManager = false;
    $academies = []; // Initialize $academies variable

    if ($user) {
        if ($user instanceof Staff) {
            $role = $user->role;
            if ($role === 'super_manager') {
                $isSuperManager = true;
                $academies = Academy::with('staff')->get();
            } elseif ($role === 'manager' || $role === 'trainer') {
                $academies = $user->academies()->with('staff')->get();
            }
        } elseif ($user instanceof Student) {
            $academies = $user->academy()->with('students')->get();

        }
    }

    $allmanagers = Staff::where('role', 'manager')->get();

    return view('academies.index', compact('academies', 'isSuperManager', 'allmanagers'));
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
        $validated = $request->validate([
            'academy_name' => 'required|string|max:255',
            'academy_location' => 'required|string|max:255', // Ensure location is required and validated
            'academy_description' => 'nullable|string',
            'manager_id' => 'nullable|exists:staff,id',
        ]);
    
        $academy = Academy::create([
            'academy_name' => $validated['academy_name'],
            'academy_location' => $validated['academy_location'], // Save location
            'academy_description' => $validated['academy_description'] ?? '',
        ]);
    
        // Assign manager if selected
        if (!empty($validated['manager_id'])) {
            $academy->staff()->attach($validated['manager_id']);
        }
    
        return redirect()->route('academies')->with('success', 'Academy created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Academy  $academy
     * @return \Illuminate\Http\Response
     */
    public function show(Academy $academy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academy  $academy
     * @return \Illuminate\Http\Response
     */
    public function edit(Academy $academy)
    {
        $academy = Academy::find($academy->id);
        if (!$academy) {
            Session::flash('error', 'There is no academy with that ID.');
            return redirect()->route('academies');
        }

        // Fetch managers to display in the dropdown. Adjust role check as necessary.
        $managers = Staff::where('role', 'manager')->get();
        return view('academies.editacademy', compact('academy', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academy  $academy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $academy = Academy::find($id);
    
        if (!$academy) {
            Session::flash('error', 'There is no academy with that ID.');
            return redirect()->route('academies');
        }
    
        $academy->update([
            'academy_name' => $request->academy_name,
            'academy_location' => $request->academy_location,
        ]);
    
        if ($request->has('manager_id') && $request->manager_id) {
            $academy->staff()->sync([$request->manager_id]);
        }
    
        Session::flash('success', 'Academy updated successfully.');
        return redirect()->route('academies');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academy  $academy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academy $academy)
    {
        //
    }
}
