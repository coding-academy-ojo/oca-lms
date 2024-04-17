<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterpieceController extends Controller
{
    public function index()
    {
        //$tasks = Masterpiece::all();
        return view('pages/masterpiece');
    }

    public function store()
    {
    }
}
