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

Route::get('/projectDetails', function () {
    return view('project.projectDetails');
})->name('projectDetails');

Route::get('/testsujoud', function () {
    return view('project.testsujoud');
})->name('testsujoud');