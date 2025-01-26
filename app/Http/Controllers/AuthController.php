<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// registration logics here
use Illuminate\Support\Facades\Validator; // Add this line

use Illuminate\Support\Facades\Mail;

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
            'password' => 'nullable', // Password is optional if OTP is used
        ]);


        // If no password is provided, proceed to send OTP
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if email is verified
            if (!$user->hasVerifiedEmail()) {
                return back()->withErrors(['email' => 'Please verify your email first.']);
            }

            $otp = rand(100000, 999999);

            // Store OTP in the database (Otp model should be used here)
            Otp::updateOrCreate(
                ['email' => $request->email],
                [
                    'otp' => $otp,
                    'otp_expires_at' => Carbon::now()->addMinutes(10),
                ]
            );

            // Send OTP to the user's email
            try {
                Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
                    $message->to($request->email)
                        ->subject('Your OTP for Login');
                });

                // Return view to enter OTP
                return view('auth.verify-otp', ['email' => $request->email])
                    ->with('success', 'OTP sent successfully. Please check your email.');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to send OTP. Please try again.');
            }
        }

        return back()->withErrors(['email' => 'The provided email does not match our records.']);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');

        // Check if the OTP matches
        $user = User::where('email', $email)->first();

        if ($user && $user->otp === $otp && Carbon::now()->lessThan($user->otp_expires_at)) {
            // OTP verified, log the user in
            Auth::login($user);

            // Update email_verified_at if not already verified
            if (!$user->hasVerifiedEmail()) {
                $user->email_verified_at = Carbon::now();
            }

            // Optionally, clear OTP after successful login
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect('/')->with('success', 'Login successful. Email verified.');
        }

        return redirect()->back()->withInput()->withErrors(['otp' => 'Invalid OTP or OTP has expired.'])->with([
            'otp_sent'=>true,
            'email'=>$email,
        ]);
    }




    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->input('email');
        $otp = rand(100000, 999999);

        // Find user and update OTP
        $user = User::where('email', $email)->first();
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP email
        try {


            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your OTP Code');
            });

            // Redirect with success message
            return redirect()->back()->with(['otp_sent' => true, 'email' => $email]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send OTP. Please try again.');
        }
    }



    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;

        // Find the user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            $otp = rand(100000, 999999); // Replace with Str::random(6) for more security

            // Update OTP and expiration time
            $user->otp = $otp; // Use Hash::make($otp) for more security
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            // Resend OTP email
            try {
                Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Your OTP Code');
                });

                return redirect()->back()->with(['otp_sent' => true, 'email' => $email]);
            } catch (\Exception $e) {
                \Log::error('OTP email failed to send: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to resend OTP. Please try again.');
            }
        }

        return redirect()->back()->withErrors(['email' => 'If the email exists in our system, you will receive an OTP.']);
    }



    // displaying registration form
    public function showRegistrationForm()
    {
        return view('public.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $request->id . ',id',
            'contact' => 'required|digits:10|unique:users,contact',
            'gender' => 'required|in:male,female,other',
            'education_qualification' => 'required|string|max:255',
            'dob' => 'required|date|before_or_equal:today',
            // 'password' => 'required|string|min:8|confirmed',

        ], [
            'email.unique' => 'The email address is already taken.',
            'contact.unique' => 'The contact number is already in use.',
            'contact.digits' => 'The contact number must be exactly 10 digits.',
            'dob.date' => 'The date of birth must be a valid date.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
    //    $user->password = bcrypt($request->password); // Use bcrypt for password hashing
        $user->contact = $request->contact;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->education_qualification = $request->education_qualification;
        $user->save();

        // Send confirmation email
        Mail::send('emails.registration', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Registration Successful');
        });

        return redirect()->route('auth.login')->with('success', 'Registration successful. A confirmation email has been sent to your email address.');
    }



    // logout method
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'You have been logged out.');
    }
}
