<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/project', function () {
    return view('project.project');
})->name('project');
Route::get('/createProject', function () {
    return view('project.createProject');
})->name('createProject');
Route::get('/createProjectSkills', function () {
    return view('project.createProjectSkills');
})->name('createProjectSkills');