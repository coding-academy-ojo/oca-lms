<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;
use App\Masterpiece;
use App\MasterpieceTask;
use App\MasterpieceProgress;


class MasterpieceController extends Controller
{
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
        $students = $runningCohort->students;
        $tasks = MasterpieceTask::allTaskNames();
        dd($runningCohort);
       return view('Pages.masterpiece', compact('students', 'tasks'));
    }

    public function setTaskDeadline(Request $request)
    
    {
      // Validate the request data
      $request->validate([
        'task_id' => 'required|exists:masterpiece_tasks,id',
        'deadline' => 'required|date',
    ]);

    // Retrieve task ID and deadline date from the request
    $taskId = $request->input('task_id');

    // Find the masterpiece task by ID
    $task = MasterpieceTask::find($taskId);

    // Update the deadline for the task
    $task->deadline = $request->input('deadline');
    $task->save();

    return redirect()->back()->with('success', 'Task deadline set successfully.');
    }
    
    public function storeProgress(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'student_id' => [
                'required',
                Rule::exists('students', 'id')->where(function ($query) use ($request) {
                    $query->where('id', $request->input('student_id'));
                }),
            ],
            'task_id' => 'required|exists:masterpiece_tasks,id',
            'progress' => 'required|integer|between:0,100',
            'notes' => 'nullable|string',
        ]);
    
        // Get the staff ID from the authenticated user
        $staffId = Auth::guard('staff')->user()->id;
    
        // Check if a progress record already exists for the student and task
        $existingProgress = MasterpieceProgress::where('student_id', $validatedData['student_id'])
            ->where('masterpiece_task_id', $validatedData['task_id'])
            ->first();
    
        if ($existingProgress) {
            // Update the existing progress record
            $existingProgress->update([
                'progress' => $validatedData['progress'],
                'notes' => $validatedData['notes'],
            ]);
    
        } else {
            // Create the progress data array
            $progressData = [
                'student_id' => $validatedData['student_id'],
                'staff_id' => $staffId,
                'masterpiece_task_id' => $validatedData['task_id'],
                'progress' => $validatedData['progress'],
                'notes' => $validatedData['notes'],
            ];
    
            // Insert the progress data into the database
            $masterpieceProgress = MasterpieceProgress::create($progressData);
    
            // Attach the task to the progress using the pivot table
            $masterpieceProgress->tasks()->attach($validatedData['task_id']);
        }
    
        // Redirect the user after successful insertion/update
        return redirect()->back()->with('success', 'Progress entry submitted successfully.');
    }


    public function updateCertificate(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'certificate_type' => 'required|string',
        ]);

        $student = Student::find($request->student_id);
        $student->certificate_type = $request->certificate_type;
        $student->save();

        return redirect()->back()->with('success', 'Certificate type updated successfully.');
    }

    public function updateInternship(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'internship_status' => 'required|boolean',
        ]);

        $student = Student::find($request->student_id);
        $student->internship_status = $request->internship_status;
        $student->save();

        return redirect()->back()->with('success', 'Internship status updated successfully.');
    }
    

}