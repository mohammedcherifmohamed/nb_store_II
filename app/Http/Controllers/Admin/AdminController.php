<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AdminController extends Controller{
   
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

   public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) 
                ->withInput(); 
        }

        $validated = $validator->validated();

        $admin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($admin) {
            return redirect()->back()
                ->with('success', 'Admin created successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Something went wrong.');
        }
    }

    public function destroy($id){
        $admin = User::findOrFail($id);
        // Prevent deletion of the currently logged in admin
        if (auth()->id() === $admin->id) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account.');
        }


        $res = $admin->delete();
        if ($res) {
            return redirect()->back()
                ->with('success', 'Admin deleted successfully.');
        } else {    
        return redirect()->back()
            ->with('eror', 'Cannot delete Admin');
        }
    }

    public function getAdmin($id){
        $admin = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'admin' => $admin
        ]);
    }

    public function update(Request $request, $id){
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$admin->id ,
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $res = $admin->save();
        if($res){
            return redirect()->back()->with('success', 'Admin updated successfully.');
            
        }else{
            return redirect()->back()->with('error', ' could not updated Admin .');
            
        }
    }

    public function search(Request $request){
        $q = trim($request->query('query', ''));

        $admins = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->get(['id','name','email']); 
            if($admins)
                return response()->json(['success' => true,'admins' => $admins]);
            else    
                return response()->json(['success' => false]);
    
        }   




}
