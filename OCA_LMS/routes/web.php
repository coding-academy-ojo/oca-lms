<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
// Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// classrome resource route

// Route::resource('classrooms', 'ClassroomController');

//Rawan Abuseini route

// announcements routes
// Route::get('/announcements', [AnnouncementController::class, 'index']);
// Route::post('/announcements', [AnnouncementController::class, 'store'])-> name('store');
// Route::delete('/{announcement:id}', [AnnouncementController::class, 'destroy'])-> name('destroy');

Route::get('/announcements', function () {
    return view('Pages/announcements');
})->name('announcements');