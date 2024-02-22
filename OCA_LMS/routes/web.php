<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\CohortController;

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

// staff login
Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// students login
Route::get('/login/student', 'AuthController@showStudentLoginForm')->name('student.login.form');
Route::post('/login/student', 'AuthController@studentLogin')->name('student.login');

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





//START Academeies  gruop routes ///////
Route::get('/academies', [AcademyController::class, 'index'])->name('academies');
Route::get('/academies/{academy}/edit', [AcademyController::class, 'edit'])->name('editacademy');
Route::put('/academies/{academy}', [AcademyController::class, 'update'])->name('academies.update');
Route::post('/academies', [AcademyController::class, 'store'])->name('academies.store');
Route::get('/academies/{academy}', [AcademyController::class, 'show'])->name('academies.show');
//END  Academeies  gruop routes ///////


// start cohort

Route::get('/cohorts/{academyId?}', [CohortController::class, 'index'])->name('academyview');
Route::get('/cohorts/{cohort}/edit', [CohortController::class, 'edit'])->name('cohortedit');







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

Route::get('/assignment/allfeedback', function () {
    return view('Pages/allAssignmentfeddback');
})->name('allAssignmentfeddback');

///////////////////////////////////
// ayman

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






