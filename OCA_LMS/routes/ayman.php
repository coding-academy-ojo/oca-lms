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






Route::get('/topics', function () {
    return view('topics.topics');
})->name('topics');
Route::get('/createTopics', function () {
    return view('topics.createTopics');
})->name('createTopics');
Route::get('/editTopics', function () {
    return view('topics.editTopics');
})->name('editTopics');



Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');

Route::get('/editProfile', function () {
    return view('profile.editProfile');
})->name('editProfile');



Route::get('/skillsFramework', function () {
    return view('skillsFramework.skillsFramework');
});
Route::get('/addSkillsLevel', function () {
    return view('skillsFramework.addSkillsLevel');
});
Route::get('/addSkillsFramework', function () {
    return view('skillsFramework.addSkillsFramework');
});
Route::get('/editSkillsLevel', function () {
    return view('skillsFramework.editSkillsLevel');
});
Route::get('/editSkillsFramework', function () {
    return view('skillsFramework.editSkillsFramework');
});
