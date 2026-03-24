<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('attendance')->group(function () {
    Route::get('/qr', [App\Http\Controllers\AttendanceController::class, 'getDailyQr']);
    Route::post('/checkin', [App\Http\Controllers\AttendanceController::class, 'checkin']);
    Route::post('/checkout', [App\Http\Controllers\AttendanceController::class, 'checkout']);
    Route::get('/my', [App\Http\Controllers\AttendanceController::class, 'myAttendance']);
    Route::get('/cohort/{cohortId}', [App\Http\Controllers\AttendanceController::class, 'getAttendanceByCohort']);
});

Route::get('/students/list', [App\Http\Controllers\FaceEnrollmentController::class, 'getStudentsList']);
Route::get('/academies', [App\Http\Controllers\FaceEnrollmentController::class, 'getAcademies']);
Route::get('/cohorts', [App\Http\Controllers\FaceEnrollmentController::class, 'getCohorts']);
Route::post('/students/enroll-face', [App\Http\Controllers\FaceEnrollmentController::class, 'enrollFace']);
Route::get('/students/{id}/face-data', [App\Http\Controllers\FaceEnrollmentController::class, 'getFaceData']);

