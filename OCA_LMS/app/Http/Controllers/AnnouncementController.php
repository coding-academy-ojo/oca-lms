<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Absence;
use App\Student;
use Illuminate\Support\Facades\DB;




class AnnouncementController extends Controller
{
    //   Display all of the Announcements.
    
    public function index()
    {
        $cohortId = session("cohort_ID");
        //dd(session("cohort_ID"));
        $announcements = Announcement::where('cohort_id', $cohortId)->latest()->get(); 
        // get cohort id from session based on studen id and use it to get cohort announcements in students view 
        $studentId = session('student_id');
        
        $student = Student::find($studentId);
        //$cohortId = $student->cohort_id;
        dd($studentId);
        // Count total absences for the specified cohort
        $totalAbsenceCount = Absence::whereHas('student', function ($query) use ($cohortId) {
            $query->where('cohort_id', $cohortId);
        })->count();
   
        // Count absences for each student in the cohort
        $absenceCounts = Absence::select('student_id', DB::raw('COUNT(*) as count'))
                                 ->whereHas('student', function ($query) use ($cohortId) {
                                     $query->where('cohort_id', $cohortId);
                                 })
                                 ->groupBy('student_id')
                                 ->get();
        
        return view('Pages/announcements', compact('announcements', 'totalAbsenceCount', 'absenceCounts'));
    }


   
    //  Store a newly created Announcement in DB.
   
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'content' => 'required',
        ]);
         $staffId = Auth::id();
         $cohortId = session("cohort_ID");

        // Create a new instance of the Announcement model with the validated data
        $announcement = new Announcement();
        $announcement->content = $validatedData['content'];
        $announcement->date = now(); 
        $announcement->staff_id = $staffId;
        $announcement->cohort_id = $cohortId;
        // Save the announcement to the database
        $announcement->save();
    
        // Redirect back with a success message or perform any other action
        return back()->with('success', 'Announcement created successfully!');
    }

   // updating announcements data 
    public function update(Request $request, $id)
    {
       
       $validatedData = $request->validate([
        'content' => 'required',]);

    $announcement = Announcement::findOrFail($id);
    $announcement->content = $validatedData['content'];
    $announcement->save();

    return back()->with('success', 'Announcement updated successfully!');
    }

   
    //   Remove the specified Announcement from DB.
      function destroy(Announcement $announcement)
    {
        $announcement -> delete(); 
        return back();
    }
}