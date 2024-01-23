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
                return '/home';
            case 'super_manager':
                return '/home';
            case 'trainer':
                return '/trainer-home';
            case 'trainee':
                return '/home';
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
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.')->withInput();
        }
    }

    

    public function logout()
    {
        Auth::logout();
        
        // Redirect to the login page
        return redirect('/login')->with('success', 'You have been logged out.');
    }
    
    
    
}
