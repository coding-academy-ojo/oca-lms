





<?php

use App\AssignmentFeedback;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentFeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyCategoryController;
use App\Http\Controllers\TechnologyCohortController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SuperManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AnnouncementController;

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
Route::get('/announcements', [AnnouncementController::class, 'index'])-> name('Announcements');
Route::post('/announcements', [AnnouncementController::class, 'store'])-> name('announcements.store');
Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/{announcement:id}', [AnnouncementController::class, 'destroy'])-> name('destroy');

// Add Trainee route

Route::get('/addTrainee', function () {
    return view('trainer/addTrainee');
})->name('addTrainee');

////////////////////////////////////////////////


//attendance & absense
Route::get('/attendance', [AbsenceController::class, 'index'])->name('attendance');
Route::post('/attendance/store-or-update', [AbsenceController::class, 'storeOrUpdate'])->name('attendance.storeOrUpdate');


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
Route::get('/cohorts/view-cohort/{cohort}', [CohortController::class, 'show'])->name('view-cohort');
Route::put('/cohort/{cohort_id}', [CohortController::class, 'update'])->name('update-cohort');
Route::post('/cohorts', [CohortController::class, 'store'])->name('store-cohort');

// super maneger
Route::get('/supermanager-dashboard', [SuperManagerController::class, 'index'])->name('supermanager-dashboard');



// staff controller
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');


// trainee progress details
Route::get('/cohort/progress-details', function () {
    return view('trainer.trainee-progress-details');
})->name('trainee-progress-details');
// attendance


// absence
Route::get('/absence-report', function () {
    return view('supermaneger.absence');
})->name('absence');
Route::get('/absence-report/trainee', function () {
    return view('supermaneger.spacificUserReport');
})->name('spacificUserReport');
// staff
// Route::get('/staff', function () {
//     return view('supermaneger.staff');
// })->name('staff');
// Route::get('/staff/edit', function () {
//     return view('supermaneger.editStaff');
// })->name('staff.edit');


/////////////////////////////////////////////
// rawan bilal
Route::get('/create-material', function () {
    return view('Pages/create_material');
})->name('create-material');

Route::get('/edit-material', function () {
    return view('Pages/edit_material');
})->name('edit-material');

Route::get('/create_assignment', function () {
    return view('Assignment/create_assignment');
})->name('create_assignment');

Route::get('/edit_assignment', function () {
    return view('Pages/edit_assignment');
})->name('edit_assignment');


Route::get('/submit_assignment', function () {
    return view('Pages/submit_assignment');
})->name('submit_assignment');

Route::get('/view_material', function () {
    return view('Pages/view_material');
})->name('view_material');

Route::get('/assignment/allfeedback', function () {
    return view('Pages/allAssignmentfeddback');
})->name('allAssignmentfeddback');
//Assignment Route
Route::get('/Assignments', [AssignmentController::class, 'index'])->name('assignments');
Route::get('/Assignment/create', [AssignmentController::class ,'create'])->name('assignment.create');
Route::post('/asssignment/store', [AssignmentController::class ,'store'])->name('assignment.store');
Route::get('/assignments/{assignment}', [AssignmentController::class ,'show'])->name('assignment.show');
Route::get('/assignment/{assignment}/edit', [AssignmentController::class ,'edit'])->name('assignment.edit');
Route::put('/assignment/{assignment}', [AssignmentController::class ,'update'])->name('assignment.update');
Route::delete('/assignment/{assignment}', [AssignmentController::class ,'destroy'])->name('assignment.destroy');
Route::get('/download/{filename}', [AssignmentController::class, 'downloads'])->name('download');
Route::delete('assignment/{assignment}/student/{student}',[AssignmentController::class,'removeStudent'] )->name('assignment.removeStudent');

//student assignment&submission route
Route::get('Student/Assignments', [AssignmentSubmissionController::class, 'index'])->name('student.assignments');
Route::post('Student/asssignment/store', [AssignmentSubmissionController::class ,'store'])->name('Student.assignment.store');
Route::get('Student/assignments/{assignment}', [AssignmentSubmissionController::class ,'show'])->name('Student.assignment.show');

//Assignment Feedback
Route::get('/Assignments/feedback', [AssignmentFeedbackController::class, 'index'])->name('assignments.feedback');
Route::get('/Assignments/feedback/{assignmnet}', [AssignmentFeedbackController::class, 'show'])->name('assignment.feedbacksubmission.show');






//Topic route
Route::get('/Topic/create', [TopicController::class ,'create'])->name('topic.create');
Route::post('/topic/store', [TopicController::class ,'store'])->name('topic.store');
Route::get('/topic/{topic}/edit', [TopicController::class ,'edit'])->name('topic.edit');
Route::put('/topic/{topic}', [TopicController::class ,'update'])->name('topic.update');
Route::delete('/topic/{topic}', [TopicController::class ,'destroy'])->name('topic.destroy');






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
// Route::get('/editTopics', function () {
//     return view('topics.editTopics');
// })->name('editTopics');



// Route::get('/profile', function () {
//     return view('profile.profile');
// })->name('profile');

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




// View skills
Route::get('/skills', [SkillController::class, 'index'])->name('skillsFramework');
// Add skill - Show form
Route::get('/skills/add', [SkillController::class, 'create'])->name('createskillsFramework');
// Store new skill
Route::post('/skills/add', [SkillController::class, 'store'])->name('addskillsFramework');
// Edit skill - Show form
Route::get('/skills/{skill}/edit', [SkillController::class, 'edit'])->name('editSkill');
// Update skill
Route::put('/skills/{id}/update', [SkillController::class, 'update'])->name('updateSkill');



// Route::get('editSkillsLevel/{level}/edit', [SkillLevelController::class, 'edit'])->name('editSkillLevel');
Route::get('editSkillsLevel/{skill}/edit', 'SkillLevelController@edit')->name('editSkillLevel');
Route::put('/updateSkillLevel/{level}/update', 'SkillLevelController@update')->name('updateSkillLevel');





Route::get('/categories', [TechnologyCategoryController::class, 'index'])->name('categories.index');
// View technologies within a specific category
Route::get('/categories/{category}', [TechnologyCategoryController::class, 'show'])->name('categories.show');


// View technology details
Route::get('/technologies/{technology}', [TechnologyController::class, 'show'])->name('technology.show');
Route::get('/technologies/create/{category}', [TechnologyController::class, 'create'])->name('technology.create');
Route::post('/technologies', [TechnologyController::class, 'store'])->name('technology.store');
Route::get('/technology/{technology}', [TechnologyController::class, 'showInfo'])->name('technology.showInfo');

Route::get('/technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('technology.edit');
Route::put('/technologies/{technology}/update', [TechnologyController::class, 'update'])->name('technology.update');
Route::delete('/technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technology.destroy');
Route::post('/technologies/{technology}/addToCohort', [TechnologyCohortController::class, 'addToCohort'])->name('technology.addToCohort');
// Route::post('technologies/addToCohort', 'TechnologyController@addToCohort')->name('technology.addToCohort');



Route::get('/rodmap', [TechnologyCategoryController::class, 'indexCohort'])->name('categories.indexCohort');
Route::get('/rodmap/{category}', [TechnologyCohortController::class, 'show'])->name('rodmap.show');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/reset-password', [ProfileController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ProfileController::class, 'resetPassword'])->name('password.update');

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



////////////////////////////////////////////////////////////////////////////////

//  ************************ Sujoud Mohammad *******************************

// view all project
Route::get('/projects', [ProjectController::class, 'showAllProjects'])->name('show_all_projects');

// Add Project
Route::get('/add_project', [ProjectController::class, 'showAddProjectForm'])->name('show_add_project_form');
Route::post('/add_project', [ProjectController::class, 'addProject'])->name('add_project');

// Add Project Skills Level
Route::get('/add_project_skills_level/{project_id}', [ProjectController::class, 'showAddProjectSkillsLevelForm'])->name('add_project_skills_level');
Route::post('/add_project_skills_level', [ProjectController::class, 'processProjectSkillsLevelForm'])->name('process_project_skills_level_form');

// Project Brief
Route::get('/project_brief/{id}', [ProjectController::class, 'showProjectBrief'])->name('project_brief');

// Edit Project
Route::get('/edit_project/{id}', [ProjectController::class, 'editProject'])->name('edit_project');
Route::put('/update_project/{id}', [ProjectController::class, 'updateProject'])->name('update_project');

// Edit Project Skills Level
Route::get('/edit_project_skills_level/{id}', [ProjectController::class, 'editProjectSkillsLevel'])->name('edit_project_skills_level');
Route::put('/update_project_skills_level/{id}', [ProjectController::class, 'updateProjectSkillsLevel'])->name('update_project_skills_level');

// // Show modal
Route::get('/add_project_submission_modal/{project_id}', 'ProjectController@showAddProjectSubmissionModal')->name('show_add_project_submission_modal');

// // Process form submission
Route::post('/process_project_submission/{project_id}', 'ProjectController@processProjectSubmission')->name('process_project_submission');

Route::get('/view_project_submissions/{project_id}', 'ProjectController@viewProjectSubmissions')->name('view_project_submissions');

Route::post('/process_feedback/{submission_id}', 'ProjectController@processFeedback')->name('process_feedback');

Route::get('/view_submissions_feedback/{project_id}', 'ProjectController@viewSubmissionsAndFeedback')->name('view_submissions_feedback');

// Route::get('/view_conversation/{project_id}/{submission_id}', 'ProjectController@viewConversation')->name('view_conversation');

// Route::get('/view_submissions_feedback/{project_id}/{student_id}', 'ProjectController@viewSubmissionsAndFeedback')->name('view_submissions_feedback');



