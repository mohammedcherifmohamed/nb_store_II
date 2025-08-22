<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;


class CoursesController extends Controller
{
    public function AddCourse(Request $req){

        $validatedData = $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date",
            "duration" => "required|min:0",
            "status" => "required|in:active,inactive"
        ],
            [
                'start_date.before' => 'The start date must be before the end date.',
                'end_date.after'   => 'The end date must be after the start date.',
            ]
        );
        if ($req->hasFile('image')) {
            $imageName = time().'.'.$req->file('image')->extension();
            $req->file('image')->move(public_path('courses'), $imageName);
            $course_image = $imageName;
        }else{
            $course_image = "default-course.jpg";
        }
         try{
    
            Courses::create([
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'duration' => $validatedData['duration'],
                    'price' => $validatedData['price'],
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'image' => $course_image,
                    'status' => $validatedData['status'],
            ]);

        return redirect()->back()->with('success', 'Course added successfully!');
        }catch(\Exception $e){
                \Log::error('Course creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }
    
   public function destroy($id){
    $course = Courses::findOrFail($id);

    $imagePath = public_path('courses/' . $course->image);

    if ($course->image && $course->image !== 'default-course.jpg' && file_exists($imagePath)) {
        unlink($imagePath);
    }

    $course->delete();

    return redirect()->back()->with('success', 'Course deleted successfully!');
}
public function update(Request $request, $id){
    $course = Courses::findOrFail($id);

    $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date",
            "duration" => "required|min:0",
            "status" => "required|in:active,inactive"
    ]);

    $course->title = $request->title;
    $course->price = $request->price;
    $course->duration = $request->duration;
    $course->status = $request->status;
    $course->start_date = $request->start_date;
    $course->end_date = $request->end_date;
    $course->description = $request->description;

    // Handle image upload
    if ($request->hasFile('image')) {
        // delete old image (except default)
        if ($course->image && $course->image !== 'default-course.jpg' && file_exists(public_path('courses/'.$course->image))) {
            unlink(public_path('courses/'.$course->image));
        }

        $fileName = time().'.'.$request->image->extension();
        $request->image->move(public_path('courses'), $fileName);
        $course->image = $fileName;
    }

    $course->save();

    return redirect()->back()->with('success', 'Course updated successfully!');
}

public function getCourse($id)
{
    $course = Courses::findOrFail($id);
    return response()->json([
        "success" => true ,
        "course" => $course
    ]);
}

public function filter(Request $request)
{
    $query = Course::query(); 
    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }


    $courses = $query->get();

    return response()->json([
        'success' => true,
        'courses' => $courses
    ]);
}



}
