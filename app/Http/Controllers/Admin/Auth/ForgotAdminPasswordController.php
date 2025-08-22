<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPassword as ForgotAdminpassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotAdminPasswordController extends Controller
{
    public function showResetForm($token){
        // check if token exists in DB
        $user = User::where('reset_token', $token)->first();

        if (!$user) {
            return "Invalid or expired token.";
        }

        return view('Admin.Auth.reset-password',compact('token'));
    }


    public function checkAdmin(Request $req){
        $req->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $admin = User::where('email', $req->input('email'))->first();

        if ($admin) {
            try {
                $token = Str::random(60);

                $admin->reset_token = $token;
                $admin->save();

                // send mail with reset link
                Mail::to($req->input('email'))->send(new ForgotAdminpassword(['token' => $token, 'email' => $admin->email]));
                    return view('ForgotSuccess');

            } catch (\Exception $e) {
                return "Mail Failed: " . $e->getMessage();
            }
        }
    }

    public function resetPassword(Request $req){
        $req->validate([
            'token' => 'required',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::where('reset_token', $req->token)->first();

        if (!$user) {
            return back()->withErrors(['token' => 'Invalid token']);
        }
        try{

            // update password
            $user->password = bcrypt($req->password);
            $user->reset_token = null; // clear token
            $user->save();
            return view('ResetSuccess');
            
        }catch(\Exception $e){
            return back()->withErrors(['password' => $e->getMessage()]);
        }
    }


}
