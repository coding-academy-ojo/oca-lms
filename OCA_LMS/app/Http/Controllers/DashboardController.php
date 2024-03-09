<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Staff;
use App\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user() ?? Auth::guard('students')->user();

        if (!$user) {
            return redirect('/login'); 
        }

        return redirect($this->redirectToRoleDashboard($user));
    }

    protected function redirectToRoleDashboard($user)
    {
        if ($user instanceof Staff) {
            switch ($user->role) {
                case 'super_manager':
                    return '/supermanager-dashboard';
                case 'manager':
                    return '/academies';
                case 'trainer':
                    return '/cohorts';
                default:
                    return '/';
            }
        } elseif ($user instanceof Student) {
            return '/cohorts';
        } else {
            return '/'; 
        }
    }
}
