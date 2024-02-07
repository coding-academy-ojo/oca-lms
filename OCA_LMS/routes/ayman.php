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
});
Route::get('/createTopics', function () {
    return view('topics.createTopics');
});
Route::get('/editTopics', function () {
    return view('topics.editTopics');
});



Route::get('/profile', function () {
    return view('profile.profile');
});







Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');