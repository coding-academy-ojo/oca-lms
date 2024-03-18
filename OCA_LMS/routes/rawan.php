<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Add Trainee route

Route::get('/addTrainee', function () {
    return view('trainer/addTrainee');
})->name('addTrainee');


//Trainees progress page
Route::get('/traineesProgress', function () {
    return view('trainer/traineesProgress');
})->name('traineesProgress');