<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Mail\SendEnrolment;
use App\Http\Controllers\SendEmail;
use App\Http\Controllers\ContactMeController;





Route::get('/', [HomeController::class, 'loadhome'])->name('home');
Route::get('/SubmitEnrollment', [SendEmail::class, 'submitEnrollment'])->name('enroll.post');
Route::get('/SendQuestion', [ContactMeController::class, 'SendQuestion'])->name('contact.post');

Route::get('admin/login', [AdminController::class, 'loadLogin'])->name('login');
Route::post('admin/login', [AuthenticationController::class, 'checklogin'])->name('login.post');

Route::get('admin/logout', [AuthenticationController::class, 'logout'])->name('logout');


Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'loadDashboard'])->name('admin.dashboard');
    Route::post('/dashboard/courses', [CoursesController::class, 'AddCourse'])->name('course.add');

    Route::delete('/course/{id}', [CoursesController::class, 'destroy'])->name('course.delete');
    Route::put('/course/{id}', [CoursesController::class, 'update'])->name('course.update');
    Route::get('/courses/{id}/json', [CoursesController::class, 'getCourse'])->name('courses.json');
    Route::get('/courses/filter', [CoursesController::class, 'filter'])->name('courses.filter');
    
    Route::get('/admins', [AdminController::class, 'loadAdmin'])->name('admin.load');


});
