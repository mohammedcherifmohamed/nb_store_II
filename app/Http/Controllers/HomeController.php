<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;


class HomeController extends Controller
{
    public function loadhome(){
        $courses = Courses::all();
        return view('home',compact('courses'));
    }
}
