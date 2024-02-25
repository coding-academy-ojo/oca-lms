<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperManagerController extends Controller
{
    public function index(){
        return view('supermaneger.dashboard');
    }
}
