<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function checklogin(Request $req){
        $req->validate([
            'email' => "required|email",
            'password' => "required|min:3"
        ]);
       
        if (Auth::attempt($req->only('email', 'password'))) {
            $req->session()->regenerate();
            return redirect()->intended('/admin/dashboard')->with('success', 'Login successful!');
        }

        // If login fails
        return back()->withErrors([
            'errors' => 'Invalid credentials, please try again.',
        ]);


    }

    public function logout(){
        Auth::logout();
        return redirect()->back()->with('success', 'Logout successful!');
    }

    public function LoadForgotPassword(){
        return view('Admin.Auth.Forgot');
    }

}
