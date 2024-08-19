<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PublicControlller extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view("public.homepage")->with('courses', $courses);
    }

    public function logIn() {}

    // to visit the sign up page
    public function apply()
    {
        return view("public.register");
    }

    // to actually sign up
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('public.index');
    }

    public function viewCourse() {}
}
