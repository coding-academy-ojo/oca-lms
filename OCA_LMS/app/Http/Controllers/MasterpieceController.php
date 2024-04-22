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
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        $students = $runningCohort->students;

        return view('pages.masterpiece', compact('students'));
    }

    public function storeDeadline(Request $request)
    {
        // Validate the request
        $request->validate([
            'idea_pitching_date' => 'required|date',
            'wireframe_date' => 'required|date',
            'frontend_date' => 'required|date',
            'final_version_date' => 'required|date',
            'other_deliverables_date' => 'required|date',
        ]);

        // Store the deadlines in the database
        $deadlines = Masterpiece::create([
            'idea_pitching_date' => $request->input('idea_pitching_date'),
            'wireframe_date' => $request->input('wireframe_date'),
            'frontend_date' => $request->input('frontend_date'),
            'final_version_date' => $request->input('final_version_date'),
            'other_deliverables_date' => $request->input('other_deliverables_date'),
        ]);

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Deadlines set successfully');
    }

    public function storeProgress(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'task' => 'required',
            'progress' => 'required|numeric|min:0|max:100',
            'notes' => 'required',
        ]);

        // Store the progress in the database
        $progress = new Masterpiece();
        $progress->student_id = $request->input('student_id');
        $progress->task = $request->input('task');
        $progress->progress = $request->input('progress');
        $progress->notes = $request->input('notes');
        $progress->save();

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Progress saved successfully');
    }
}
