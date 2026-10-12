<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('students.index');
});

// Student Management Routes
Route::resource('students', StudentController::class);
Route::post('students/{student}/enroll', [StudentController::class, 'enroll'])
    ->name('students.enroll');

    // Activity Management Routes
Route::resource('activities', ActivityController::class);
Route::post('activities/{activity}/submit', [ActivityController::class, 'submit'])
    ->name('activities.submit');
