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

Route::get('/home', function () {
    return view('home');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


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
// <<<<<<< HEAD
// =======

// >>>>>>> dc628028ef59da7ac47e71fe6b4531c8ded17694
Route::get('/Academeies', function () {
    return view('supermaneger.index');
})->name('Academeies');
Route::get('/Academeies/edit', function () {
    return view('supermaneger.editacademy');
})->name('editacademy');
Route::get('/Academeies/view', function () {
    return view('supermaneger.academy');
})->name('academyview');
Route::get('/academeies/view', function () {
    return view('supermaneger.editcohort');
})->name('cohortedit');
Route::get('/attendance', function () {
    return view('supermaneger.attendance');
})->name('attendance');



// rawan bilal
Route::get('/create-material', function () {
    return view('Pages/create_material');
})->name('create-material');


Route::get('/edit-material', function () {
    return view('Pages/edit_material');
})->name('edit-material');

Route::get('/create_assignment', function () {
    return view('Pages/create_assignment');
})->name('create_assignment');


Route::get('/edit_assignment', function () {
    return view('Pages/edit_assignment');
})->name('edit_assignment');


Route::get('/assignment', function () {
    return view('Pages/view_assignment');
})->name('assignment');


Route::get('/submit_assignment', function () {
    return view('Pages/submit_assignment');
})->name('submit_assignment');


Route::get('/view_material', function () {
    return view('Pages/view_material');
})->name('view_material');
