<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;


class AdminController extends Controller
{
    public function loadDashboard(){
        $courses = Courses::all();
        return view('Admin.dashboard',compact('courses'));
    }
    public function loadAdmin(){
        $admins = User::all();
        return view('Admin.Admins',compact('admins'));
    }


    public function loadLogin(){
        return view('Admin.Auth.Login');
    }
}
