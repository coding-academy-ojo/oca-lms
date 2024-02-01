<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return view('test');
});

Route::get('/test2', function () {
    return view('test2');
});






Route::get('/project', function () {
    return view('project.project');
});
Route::get('/AddProject', function () {
    return view('project.AddProject');
});
Route::get('/AddProjectSkills', function () {
    return view('project.AddProjectSkills');
});
Route::get('/ProjectBrief', function () {
    return view('project.ProjectBrief');
});
Route::get('/AddSubmitiom', function () {
    return view('project.AddSubmitiom');
});
Route::get('/ProjectSubmitiom', function () {
    return view('project.ProjectSubmitiom');
});
Route::get('/ProjectFeedback', function () {
    return view('project.ProjectFeedback');
});







Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');