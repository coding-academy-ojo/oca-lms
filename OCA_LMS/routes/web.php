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

// Academeies
Route::get('/Academeies', function () {
    return view('supermaneger.index');
})->name('Academeies');
Route::get('/Academeies/edit', function () {
    return view('supermaneger.editacademy');
})->name('editacademy');
Route::get('/Academeies/view', function () {
    return view('supermaneger.academy');
})->name('academyview');
Route::get('/academeies/edit-cohort', function () {
    return view('supermaneger.editcohort');
})->name('cohortedit');

// attendance
Route::get('/attendance', function () {
    return view('supermaneger.attendance');
})->name('attendance');

// absence
Route::get('/absence-report', function () {
    return view('supermaneger.absence');
})->name('absence');
Route::get('/absence-report/trainee', function () {
    return view('supermaneger.spacificUserReport');
})->name('spacificUserReport');
// staff
Route::get('/staff', function () {
    return view('supermaneger.staff');
})->name('staff');
Route::get('/staff/edit', function () {
    return view('supermaneger.editStaff');
})->name('staff.edit');


/////////////////////////////////////////////
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


///////////////////////////////////
// ayman


// Route::get('/test', function () {
//     return view('test');
// });

// Route::get('/test2', function () {
//     return view('test2');
// });


// Route::get('/topics', function () {
//     return view('topics.topics');
// })->name('topics');
// Route::get('/createTopics', function () {
//     return view('topics.createTopics');
// })->name('createTopics');
// Route::get('/editTopics', function () {
//     return view('topics.editTopics');
// })->name('editTopics');


// Route::get('/profile', function () {
//     return view('profile.profile');
// })->name('profile');







// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');



// //////////////////////////////////////
// // rawan 

// // Add Trainee route

// Route::get('/addTrainee', function () {
//     return view('trainer/addTrainee');
// })->name('addTrainee');


// // Trainees progress page
// Route::get('/traineesProgress', function () {
//     return view('trainer/traineesProgress');
// })->name('traineesProgress');



// ///////////////////////////////////////
// // sojoud 



// Route::get('/project', function () {
//     return view('project.project');
// })->name('project');
// Route::get('/createProject', function () {
//     return view('project.createProject');
// })->name('createProject');
// Route::get('/createProjectSkills', function () {
//     return view('project.createProjectSkills');
// })->name('createProjectSkills');






