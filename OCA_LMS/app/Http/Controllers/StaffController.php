<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Staff;
use App\Academy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('staff')->user();
    
        if ($user->role == 'super_manager') {
            $staff = Staff::where('role', '!=', 'super_manager')->paginate(5);
            $academies = Academy::all(); 
        } elseif ($user->role == 'manager') {
            $academyIds = $user->academies->pluck('id'); // Get IDs of academies the manager is associated with
            $staff = Staff::whereHas('academies', function ($query) use ($academyIds) {
                $query->whereIn('academy_id', $academyIds);
            })
            ->where('role', '=', 'trainer')
            ->where('id', '!=', $user->id) 
            ->paginate(5);
    
            $academies = Academy::whereIn('id', $academyIds)->get();
        } else {
   
            return redirect('/login')->with('error', 'Unauthorized access.');
        }
    
        return view('supermaneger.staff', compact('staff', 'academies'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_name' => 'required|string',
            'staff_email' => 'required|email|unique:staff',
            'staff_password' => 'required|string|min:6',
            'role' => 'required|in:manager,super_manager,trainer',
            'staff_cv' => 'nullable|file',
            'staff_bio' => 'nullable|string',
            'staff_personal_img' => 'nullable|image',
            'academy_id' => 'nullable|exists:academies,id', // Make academy_id optional but must exist in the academies table if provided
        ]);
    
        $validatedData['staff_password'] = Hash::make($validatedData['staff_password']);
        
        // Create the staff member without academy_id in the array
        $staff = Staff::create(Arr::except($validatedData, ['academy_id']));
    
        // Attach the staff member to the specified academy if academy_id is provided
        if (!empty($validatedData['academy_id'])) {
            $staff->academies()->attach($validatedData['academy_id']);
        }
    
        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.show', compact('staff'));
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
        $staff = Staff::with('academies')->findOrFail($id);
        $selectedAcademies = $staff->academies->pluck('id')->toArray();
    
        // For a super manager or a manager looking to edit a staff member
        if ($user->role == 'super_manager' || ($user->role == 'manager' && in_array($staff->role, ['trainer']))) {
            $academies = $user->role == 'super_manager' ? Academy::all() : $user->academies;
    
            // Pass the role of the staff being edited, not the authenticated user's role
            $editingUserRole = $staff->role; 
    
            return view('supermaneger.editStaff', compact('staff', 'academies', 'selectedAcademies', 'editingUserRole'));
        } else {
            return redirect()->route('staff.index')->with('error', 'Unauthorized access.');
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
        $staff = Staff::findOrFail($id);
        
        if ($staff->role === 'manager' && $request->has('academies')) {
            foreach ($request->academies as $academyId) {
                $otherManager = Staff::where('role', 'manager')
                                      ->whereExists(function ($query) use ($academyId) {
                                          $query->select('academy_id')
                                                ->from('academy_staff')
                                                ->whereRaw('academy_staff.staff_id = staff.id')
                                                ->where('academy_id', $academyId);
                                      })
                                      ->where('id', '!=', $staff->id)
                                      ->first();
                if ($otherManager) {
                    $otherManager->academies()->detach($academyId);
                }
            }
            $staff->academies()->sync($request->academies);
        } 
        elseif ($staff->role === 'trainer' && $request->has('academy')) {
            $staff->academies()->sync($request->academy ? [$request->academy] : []);
        } 
        else {
            $staff->academies()->detach();
        }    
        
        return redirect()->route('staff.index')->with('success', 'Staff academies updated successfully.');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
