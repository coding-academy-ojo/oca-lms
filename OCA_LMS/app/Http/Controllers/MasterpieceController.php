<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterpieceController extends Controller
{
    public function index()
    {
        $tasks = MasterpieceProgress::all();
        return view('trainer\trainee-progress-details', compact('tasks'));
    }

    public function store()
    {
    }
}
