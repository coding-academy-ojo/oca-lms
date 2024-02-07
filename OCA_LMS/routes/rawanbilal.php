<?php

use Illuminate\Support\Facades\Route;


Route::get('/create-mat', function () {
    return view('Pages/create_material');
});
Route::get('/edit-mat', function () {
    return view('Pages/edit_material');
});
Route::get('/create_ass', function () {
    return view('Pages/create_assignment');
});
Route::get('/edit_ass', function () {
    return view('Pages/edit_assignment');
});
Route::get('/assignment', function () {
    return view('Pages/view_assignment');
});
Route::get('/submit_assignment', function () {
    return view('Pages/submit_assignment');
})->name('submit_assignment');

Route::get('/view_material', function () {
    return view('Pages/view_material');
});

