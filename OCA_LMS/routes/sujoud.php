<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/project', function () {
    return view('project.project');
});
Route::get('/createProject', function () {
    return view('project.createProject');
});
Route::get('/createProjectSkills', function () {
    return view('project.createProjectSkills');
});