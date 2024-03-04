<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Staff;
use App\Academy;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academies = Academy::all();
        $staff = Staff::where('role', '!=', 'super_manager')->paginate(5);
        return view('supermaneger.staff', compact('staff'), compact('academies'));
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
        ]);

        $validatedData['staff_password'] = Hash::make($validatedData['staff_password']);
        // dd($validatedData);

        $staff = Staff::create($validatedData);

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
        $staff = Staff::with('academies')->findOrFail($id);
        $academies = Academy::all();
        $selectedAcademies = $staff->academies->pluck('id')->toArray();
        $role = $staff->role; 
        return view('supermaneger.editStaff', compact('staff', 'academies', 'selectedAcademies', 'role'));
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
            $staff->academies()->sync($request->academies);
        } elseif ($staff->role === 'trainer' && $request->has('academy')) {
            $staff->academies()->sync($request->academy ? [$request->academy] : []);
        } else {
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
