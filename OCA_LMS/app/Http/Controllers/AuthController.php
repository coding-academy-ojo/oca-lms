<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;


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
                return '/Academeies';
            case 'super_manager':
                return '/Academeies';
            case 'trainer':
                return '/Academeies';
            case 'trainee':
                return '/Academeies';
            default:
                return '/';
        }
    }
// Handle the login attempt
    public function login(Request $request)
    {
        // Validation rules
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on the user's role
            $redirectPath = $this->redirectToRoleDashboard($user->role);

            return redirect()->intended($redirectPath)->with('success', 'Welcome ' . $user->name);
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
    
    
    
}
