<?php

namespace App\Http\Controllers;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        if(!empty(Auth::check())){
            return redirect('/home');
        }
        return view('auth.login');
    }
    
    // handle the role redirect pages
    protected function redirectToRoleDashboard($role)
    {
        switch ($role) {
            case 'manager':
                return '/academies';
            case 'super_manager':
                return '/academies';
            case 'trainer':
                return '/academies';
    
            default:
                return '/';
        }
    }
// Handle the login attempt
  
public function login(Request $request)
{
    $request->validate([
        'staff_email' => 'required|email|exists:staff,staff_email',
        'password' => 'required',
    ]);

    $credentials = [
        'staff_email' => $request->input('staff_email'),
        'password' => $request->input('password'),
    ];

    // Use the 'staff' guard to attempt the login
    if (Auth::guard('staff')->attempt($credentials)) {
        $staff = Auth::guard('staff')->user();

        $redirectPath = $this->redirectToRoleDashboard($staff->role);

        return redirect()->intended($redirectPath)->with('success', 'Welcome ' . $staff->staff_name);
    } else {
        return redirect()->back()
            ->withErrors(['password' => 'The provided credentials do not match our records.'])
            ->withInput($request->except('password'));
    }
}


    

    public function logout()
    {
        Auth::logout();
        
        // Redirect to the login page
        return redirect('/login')->with('success', 'You have been logged out.');
    }
    



    // student login 

    public function showStudentLoginForm()
{

    if(!empty(Auth::check())){
        return redirect('/home');
    }
    return view('auth.student-login');
}
public function studentLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:students,email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');


    if (Auth::guard('students')->attempt($credentials)) {
        $student = Auth::guard('students')->user();
        return redirect('/academies'); // Redirect to the '/academies' route upon successful login
    } else {
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput($request->except('password'));
    }

}
    
}
