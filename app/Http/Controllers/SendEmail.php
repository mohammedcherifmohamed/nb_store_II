<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Mail\SendEnrolment;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{
 public function submitEnrollment(Request $request){
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'family_name' => 'required|string',
            'age' => 'required|numeric',
            'wilaya' => 'required|string',
            'phone' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);


        $data = [
            'course_title' => $request->title,
            'name' => $request->name,
            'Familly_name' => $request->family_name,
            'age' => $request->age,
            'wilaya' => $request->wilaya,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ];
        try {
          Mail::to('galaxyphoneacademy@gmail.com')->send(new SendEnrolment($data));
            return view("EnrollSuccess");

        } catch (\Exception $e) {
            return "Mail failed: " . $e->getMessage();
        }

    }
}
