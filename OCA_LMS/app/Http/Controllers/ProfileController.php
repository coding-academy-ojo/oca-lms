<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use app\Staff;
use app\Student;

class ProfileController extends Controller
{
    public function index()
    {
        $user = null;

        if (Auth::guard('staff')->check()) {
            // If the authenticated user is staff, fetch staff data
            $user = Auth::guard('staff')->user();
        } elseif (Auth::guard('students')->check()) {
            // If the authenticated user is a student, fetch student data
            $user = Auth::guard('students')->user();
        }

        // dd($user);
        if ($user) {
            return view('profile.profile', compact('user'));
        } else {
            abort(404);
        }
    }

    public function edit()
    {
        $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

        return view('profile.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

        // Validation rules
        $rules = [
            // Add validation rules for each field you want to update
            'staff_name' => 'required|string',
            'email' => 'required|email|unique:staff,staff_email,' . $user->id,
            // Add more rules as needed
        ];

        // Validate the request
        $validatedData = $request->validate($rules);

        // Update user profile
        $user->update($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
