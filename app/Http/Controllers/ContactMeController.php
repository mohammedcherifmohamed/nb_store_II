<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;


class ContactMeController extends Controller
{
    public function SendQuestion(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|max:500',
        ]);


     $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'usermessage' => $request->message,
        ];

        try {
            Mail::to('devtest42.me@gmail.com')->send(new ContactMe($data));
            return view("mail.ContactSucces");
        } catch (\Exception $e) {
            return "Mail failed: " . $e->getMessage();
        }

        return response()->json(['success' => true, 'message' => 'Question sent']);

    }


}
