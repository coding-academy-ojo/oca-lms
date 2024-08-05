<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use app\Staff;
use app\Student;
use App\Http\Controllers\Storage;

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

    // public function update(Request $request)
    // {
    //     $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

    //     // Determine which fields to validate based on the user's role
    //     if (Auth::guard('students')->check()) {
    //         // Validation rules for student
    //         $rules = [
    //             'en_first_name' => 'required|string',
    //             'en_second_name' => 'required|string',
    //             'en_third_name' => 'required|string',
    //             'en_last_name' => 'required|string',
    //             'email' => 'required|email|unique:students,email,' . $user->id,
    //         ];
    //     } else {
    //         // Validation rules for staff
    //         $rules = [
    //             'staff_name' => 'required|string',
    //             'email' => 'required|email|unique:staff,staff_email,' . $user->id,
    //         ];
    //     }

    //     // Validate the request
    //     $validatedData = $request->validate($rules);

    //     // Update user profile
    //     $user->update($validatedData);

    //     // Redirect back with success message
    //     return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    // }

    public function updateProfile(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'bio' => 'required|string',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated staff member
        $staff = Auth::guard('staff')->user();

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($staff->profile_image) {
                Storage::delete('public/profile_images/' . $staff->profile_image);
            }

            // Store the new profile image
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);

            // Update the profile image path in the database
            $staff->profile_image = $imageName;
        }

        // Update the staff profile
        $staff->name = $request->input('name');
        $staff->phone = $request->input('phone');
        $staff->bio = $request->input('bio');
        $staff->email = $request->input('email');
        $staff->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function showResetForm()
    {

    
        $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();
        // dd($user);
        return view('profile.resetPassword', compact('user'));
    }


    // public function resetPassword(Request $request)
    // {
    //     dd($request);
    //     $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

    //     $request->validate([
    //         'old-password' => 'required|string',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     if (!Hash::check($request->input('old-password'), $user->password)) {
    //         return redirect()->back()->withErrors(['old-password' => 'The old password provided is incorrect'])->withInput();
    //     }

    //     $user->update([
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->back()->with('success', 'Password updated successfully');
    // }



    // public function resetPassword(Request $request)
    // {
    //     $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

    //     $request->validate([
    //         'old-password' => 'required|string',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     if (!Hash::check($request->input('old-password'), $user->getAuthPassword())) {
    //         return redirect()->back()->withErrors(['old-password' => 'The old password provided is incorrect'])->withInput();
    //     }

    //     // Determine which column to update based on the user type
    //     $passwordColumn = Auth::guard('staff')->check() ? 'staff_password' : 'password';

    //     $user->update([
    //         $passwordColumn => Hash::make($request->password),
    //     ]);

    //     return redirect()->back()->with('success', 'Password updated successfully');
    // }

    
    public function resetPassword(Request $request)
    {

        // Get the authenticated user
        $user = Auth::guard('staff')->check() ? Auth::guard('staff')->user() : Auth::guard('students')->user();

        // Define validation rules
        $rules = [
            'old-password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Validate the request
        $request->validate($rules);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->input('old-password'), $user->getAuthPassword())) {
            return redirect()->back()->withErrors(['old-password' => 'The old password provided is incorrect'])->withInput();
        }

        // Determine which column to update based on the user type
        $passwordColumn = Auth::guard('staff')->check() ? 'staff_password' : 'password';

        // dd($passwordColumn);

        // Update the user's password
        $user->$passwordColumn = Hash::make($request->password);
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
