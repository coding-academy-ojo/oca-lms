





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
use App\Http\Controllers\TraineesProgressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TrainerDashboardController;
use App\Http\Controllers\AbsenceReportController;
use App\Http\Controllers\SoftSkillsTrainingController;
use App\Http\Controllers\SingleTraineeProgressController;
use App\Http\Controllers\MasterpieceController;
use App\Http\Controllers\ImportDataController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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


// announcements routes
Route::get('/announcements', [AnnouncementController::class, 'index'])-> name('Announcements');
Route::post('/announcements', [AnnouncementController::class, 'store'])-> name('announcements.store');
Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/{announcement:id}', [AnnouncementController::class, 'destroy'])-> name('destroy');

// Add Trainee route

Route::get('/addTrainee', function () {
    return view('trainer/addTrainee');
})->name('addTrainee');


// Route to show the form for creating a new masterpiece progress entry
Route::get('/masterpiece', [MasterpieceController::class, 'index'])->name('masterpiece.index');
Route::get('/masterpiece', [MasterpieceController::class, 'index'])->name('Masterpiece');
Route::post('/masterpiece/task-deadline', [MasterpieceController::class, 'setTaskDeadline'])->name('masterpiece.task.deadline.store');
Route::post('/masterpiece/progress', [MasterpieceController::class, 'storeProgress'])->name('masterpiece.progress.store');
Route::post('/update-certificate', [MasterpieceController::class, 'updateCertificate'])->name('update.certificate');
Route::post('/update-internship', [MasterpieceController::class, 'updateInternship'])->name('update.internship');


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
Route::get('/cohorts/view-cohort/{cohort}', [TrainerDashboardController::class, 'index'])->name('view-cohort');
Route::put('/cohort/{cohort_id}', [CohortController::class, 'update'])->name('update-cohort');
Route::post('/cohorts', [CohortController::class, 'store'])->name('store-cohort');

// super maneger
Route::get('/supermanager-dashboard', [SuperManagerController::class, 'index'])->name('supermanager-dashboard');
// soft skills

Route::get('soft-skills', [SoftSkillsTrainingController::class, 'index'])->name('soft-skills.index');
Route::get('soft-skills/create', [SoftSkillsTrainingController::class, 'create'])->name('soft-skills.create');
Route::post('soft-skills', [SoftSkillsTrainingController::class, 'store'])->name('soft-skills.store');
Route::get('soft-skills/{softSkillsTraining}', [SoftSkillsTrainingController::class, 'show'])->name('soft-skills.show');
Route::get('soft-skills/{softSkillsTraining}/edit', [SoftSkillsTrainingController::class, 'edit'])->name('soft-skills.edit');
Route::put('soft-skills/{softSkillsTraining}', [SoftSkillsTrainingController::class, 'update'])->name('soft-skills.update');
Route::delete('soft-skills/{softSkillsTraining}', [SoftSkillsTrainingController::class, 'destroy'])->name('soft-skills.destroy');


// staff controller
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');


//Progress
Route::get('/cohort/progress-details/{id}',[ SingleTraineeProgressController::class, 'index'])->name('ProgressDetails.showDetails');
Route::get('/traineesProgress', [TraineesProgressController::class, 'index'])->name('trainees.progress');


// absence
Route::get('/absence-report', [AbsenceReportController::class, 'index'])->name('absence');
Route::post('/absence/upload/{absence_id}', [AbsenceReportController::class,'UploudAbsenceReport'])->name('absence.upload');
Route::get('/absence/{absence_id}/download', [AbsenceReportController::class,'downloadAbsenceReport'])->name('absence.download');

Route::get('students/{studentId}/absence', 'AbsenceReportController@show')->name('spacificUserReport');

Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');


/////////////////////////////////////////////
// rawan bilal

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
Route::put('/assignment/feedback/{assignment}', [AssignmentSubmissionController::class ,'update'])->name('submission_feedback.update');
Route::put('/assignment/feedbackStatus/{assignment}', [AssignmentSubmissionController::class ,'changeStatus'])->name('changeStatus.update');



//Assignment Feedback
Route::get('/Assignments/feedback', [AssignmentFeedbackController::class, 'index'])->name('assignments.feedback');
Route::post('/Assignments/feedback/store', [AssignmentFeedbackController::class, 'store'])->name('assignment.feedbacksubmission.store');
Route::get('/Assignments/feedback/{assignmnet}', [AssignmentFeedbackController::class, 'show'])->name('assignment.feedbacksubmission.show');
Route::get('/Assignments/feedback/{id}/{studentId}', [AssignmentFeedbackController::class, 'submissionfedback'])->name('assignment.feedbacksubmission.feedback');


//Topic route
Route::get('/Topic/create', [TopicController::class ,'create'])->name('topic.create');
Route::post('/topic/store', [TopicController::class ,'store'])->name('topic.store');
Route::get('/topic/{topic}/edit', [TopicController::class ,'edit'])->name('topic.edit');
Route::put('/topic/{topic}', [TopicController::class ,'update'])->name('topic.update');
Route::delete('/topic/{topic}', [TopicController::class ,'destroy'])->name('topic.destroy');


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
Route::put('/updateSkillLevel/store', 'SkillLevelController@store')->name('storeSkillLevel');





Route::get('/categories', [TechnologyCategoryController::class, 'index'])->name('categories.index');
// View technologies within a specific category
Route::get('/categories/{category}', [TechnologyCategoryController::class, 'show'])->name('categories.show');


// View technology details
Route::get('/technologies/{technology}', [TechnologyController::class, 'show'])->name('technology.show');
Route::get('/technologies/create/{category}', [TechnologyController::class, 'create'])->name('technology.create');
Route::delete('/technology/{id}', [TechnologyController::class, 'delete'])->name('technology.delete');

Route::post('/technologies', [TechnologyController::class, 'store'])->name('technology.store');
Route::get('/technology/{technology}', [TechnologyController::class, 'showInfo'])->name('technology.showInfo');

Route::get('/technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('technology.edit');
Route::put('/technologies/{technology}/update', [TechnologyController::class, 'update'])->name('technology.update');
Route::delete('/technologies/technology/{technology}', [TechnologyController::class, 'destroy'])->name('technology.destroy');
// Route::post('/technologies/{technology}/addToCohort', [TechnologyCohortController::class, 'addToCohort'])->name('technology.addToCohort');
// Route::post('technologies/addToCohort', 'TechnologyController@addToCohort')->name('technology.addToCohort');
// Route::post('/technologies/{technology}/addToCohort', 'TechnologyController@addToCohort')->name('technology.addToCohort');
Route::post('/technology/addToCohort', 'TechnologyCohortController@addToCohort')->name('technology.addToCohort');





Route::get('/rodmap', [TechnologyCategoryController::class, 'indexCohort'])->name('categories.indexCohort');
Route::get('/rodmap/{category}', [TechnologyCohortController::class, 'show'])->name('rodmap.show');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/reset-password', [ProfileController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ProfileController::class, 'resetPassword'])->name('password.update');



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

Route::get('/assign-students/{projectId}', 'ProjectController@assignStudents')->name('assign_students');
Route::post('/assign-students/{projectId}', 'ProjectController@assignStudents')->name('assign_students');


Route::post('/update-project-status/{projectId}/{studentId}', 'ProjectController@updateProjectStatus')->name('update_project_status');
Route::get('/filter-projects', 'ProjectController@filterProjects')->name('filter_projects');



// import data
Route::get('/import-data/{id}', [ImportDataController::class, 'index'])->name('import-data.index');
Route::post('/import-data/{cohortId}', [ImportDataController::class, 'import'])->name('import-data.import');
Route::post('/import-data/import-softskills/{cohortId}', [ImportDataController::class, 'importSoftSkillsTrainings'])->name('import-data.import-softskills');
Route::post('/import-data/import-technologies/{cohortId}', [ImportDataController::class, 'importTechnologies'])->name('import-data.import-technologies');
Route::post('import-data/{cohortId}/assignments', [ImportDataController::class, 'importAssignments'])->name('import-data.import-assignments');
