<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterpieceDetail;

class MasterpieceDetailController extends Controller
{
    // Show a single trainee's masterpiece progress
    public function show($studentId)
    {
        // Fetch masterpiece details for a specific student
        $details = MasterpieceDetail::where('student_id', $studentId)->first();
        dd($details);

        // Pass data to blade
        return view('singletraineeprogress', compact('details'));
    }

    // Optional: If you want a list of all masterpieces
    public function index()
    {
        $allDetails = MasterpieceDetail::with('student')->get();
        return view('allmasterpieces', compact('allDetails'));
    }
}
