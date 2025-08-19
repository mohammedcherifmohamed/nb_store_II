<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Mail\SendEnrolment;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{
 public function submitEnrollment(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'Familly_name' => 'required|string',
            'age' => 'required|numeric',
            'wilaya' => 'required|string',
            'phone' => 'required|numeric',
        ]);

        // $course = Courses::findOrFail($request->course_id);

        $data = [
            'course_title' => $request->title,
            'name' => $request->name,
            'Familly_name' => $request->Familly_name,
            'age' => $request->age,
            'wilaya' => $request->wilaya,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ];

        Mail::to('devtest42.me@gmail.com')->send(new SendEnrolment($data));

        return response()->json(['success' => true, 'message' => 'Enrollment email sent']);
    }
}
