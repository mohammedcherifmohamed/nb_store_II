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
use App\Http\Controllers\Admin\Auth\ForgotAdminPasswordController;





Route::get('/', [HomeController::class, 'loadhome'])->name('home');
Route::get('/SubmitEnrollment', [SendEmail::class, 'submitEnrollment'])->name('enroll.post');
Route::get('/SendQuestion', [ContactMeController::class, 'SendQuestion'])->name('contact.post');

Route::get('admin/login', [AdminController::class, 'loadLogin'])->name('login');
Route::post('admin/login', [AuthenticationController::class, 'checklogin'])->name('login.post');

Route::get('admin/logout', [AuthenticationController::class, 'logout'])->name('logout');
// forgot password
Route::get("admin/forgotPassword",[AuthenticationController::class,'LoadForgotPassword'])->name('forgot.load');
Route::post("admin/forgotPassword",[ForgotAdminPasswordController::class,'checkAdmin'])->name('forgot.post');
Route::get('/reset-password/{token}', [ForgotAdminPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ForgotAdminPasswordController::class, 'resetPassword']);


Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'loadDashboard'])->name('admin.dashboard');
    Route::post('/dashboard/courses', [CoursesController::class, 'AddCourse'])->name('course.add');

    Route::delete('/course/{id}', [CoursesController::class, 'destroy'])->name('course.delete');
    Route::put('/course/{id}', [CoursesController::class, 'update'])->name('course.update');
    Route::get('/courses/{id}/json', [CoursesController::class, 'getCourse'])->name('courses.json');
    Route::get('/courses/filter', [CoursesController::class, 'filter'])->name('courses.filter');
    
    Route::get('/admins', [AdminController::class, 'loadAdmin'])->name('admin.load');
    Route::post('/admins/add', [AdminController::class, 'store'])->name('admin.post');
    Route::delete('/admins/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/admins/edit/{id}', [AdminController::class, 'getAdmin'])->name('admin.edit');
    Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/admins/search', [AdminController::class, 'search'])->name('admins.search');




});
