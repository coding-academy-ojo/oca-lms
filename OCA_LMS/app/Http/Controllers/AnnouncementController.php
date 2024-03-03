<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AnnouncementController extends Controller
{
    //   Display all of the Announcements.
    
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('Pages/announcements', compact('announcements'));
    }


   
    //  Store a newly created Announcement in DB.
   
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'content' => 'required',
        ]);
         // Create a new announcement instance
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