<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // displaying login form 
    public function showLoginForm()
    {
        if (Auth::id()) {
            return redirect()->route('student.dashboard');
        }
        return view('auth.login');
    }

    // login logics
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isAdmin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->intended('/student/dashboard');
                // return redirect()->route('student.dashboard');
            }
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }


    // displaying registration form 
    public function showRegistrationForm()
    {
        return view('public.register');
    }

    // registration logics here
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $request->id . ',id',
            'contact' => 'required|digits:10|unique:users,contact',
            'gender' => 'required|in:male,female,other',
            // 'education_qualification' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'The email address is already taken.',
            'contact.unique' => 'The contact number is already in use.',
            'contact.digits' => 'The contact number must be exactly 10 digits.',
            'dob.date' => 'The date of birth must be a valid date.',
        ]);



        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->contact = $request->contact;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->education_qualification = $request->education_qualification;
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Registration successfull');
    }


    // logout method
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'You have been logged out.');
    }
}
