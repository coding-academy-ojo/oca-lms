<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // if (Auth::guard('staff')->check()) {
        //     $user = Auth::guard('staff')->user();
        // } elseif (Auth::guard('students')->check()) {
        //     $user = Auth::guard('students')->user();
        // } else {
        //     return redirect('/login')->withErrors('You must be logged in to access this page.');
        // }

        // if (in_array($user->role, $roles)) {
        //     return $next($request);
        // }

        // return redirect('/')->withErrors('You do not have access to this page.');

        if (Auth::guard('staff')->check()) {
            $staff = Auth::guard('staff')->user();
            if (in_array($staff->role, $roles)) {
                return $next($request);
            }
            return redirect('/')->withErrors('You do not have access to this page.');
        }

        // Check if a student is logged in
        if (Auth::guard('students')->check()) {
            // Ensure this route is intended for students (no roles are needed)
            if (in_array('student', $roles)) {
                return $next($request);
            }
            return redirect('/')->withErrors('You do not have access to this page.');
        }

        return redirect('/login')->withErrors('You must be logged in to access this page.');
    }
    
}
