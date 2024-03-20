<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(){
        $student = Auth::guard('students')->user();
        return view('student.dashboard', compact('student'));
    }
}
