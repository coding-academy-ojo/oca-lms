<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;
use App\Masterpiece;

class MasterpieceController extends Controller
{
    public function index()
    {
        $tasks = Masterpiece::all();
    $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        $students = $runningCohort->students;
         //dd($students);
        return view('pages/masterpiece' , compact('students'));
       
    }
public function Store()
{
    
    return view('pages/masterpiece.create');
    

}
    

    
}
