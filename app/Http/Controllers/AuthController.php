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

        // Try login with password
        if ($request->password) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if (Auth::user()->isAdmin) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->intended('/student/dashboard');
                }
            } else {
                return back()->withErrors(['password' => 'Invalid credentials.']);
            }
        }

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

            // Optionally, you can clear OTP after successful login
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect('/'); // Redirect to dashboard or home
        }

        return redirect()->back()->withErrors(['otp' => 'Invalid OTP or OTP has expired.']);
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



    // displaying registration form 
    public function showRegistrationForm()
    {
        return view('public.register');
    }

    // public function register(Request $request)
    // {
    //     // Validation for name, email, and mobile when sending OTP
    //     if (!$request->has('otp')) {
    //         // Send OTP functionality
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|string|email|unique:users,email',
    //             'contact' => 'required|digits:10|unique:users,contact',
    //             'gender' => 'required|in:male,female,other',
    //             'education_qualification' => 'required|string|max:255',
    //             'dob' => 'required|date|before_or_equal:today',
    //         ]);

    //         // if ($validator->fails()) {
    //         //     return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
    //         // }

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 422,
    //                 'error' => $validator->messages()
    //             ], 422);
    //         }

    //         $otp = rand(100000, 999999);

    //         Otp::updateOrCreate(
    //             ['email' => $request->email],
    //             [
    //                 'otp' => $otp,
    //                 'expires_at' => now()->addMinutes(10),
    //             ]
    //         );

    //         // Store user data in session for later use
    //         $request->session()->put('user_data', $request->only(['name', 'email', 'mobile']));

    //         try {
    //             Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
    //                 $message->to($request->email)->subject('Your OTP for Registration');
    //             });

    //             return response()->json(['success' => true, 'message' => 'OTP sent successfully.']);
    //         } catch (\Exception $e) {
    //             return response()->json(['success' => false, 'message' => 'Failed to send OTP.']);
    //         }
    //     } else {
    //         // Verify OTP functionality
    //         $validator = Validator::make($request->all(), [
    //             'otp' => 'required|numeric',
    //             'email' => 'required|email',
    //         ]);

    //         // if ($validator->fails()) {
    //         //     return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
    //         // }

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => 422,
    //                 'error' => $validator->messages()
    //             ], 422);
    //         }

    //         $otpRecord = Otp::where('email', $request->email)->first();

    //         if (!$otpRecord || $otpRecord->otp != $request->otp) {
    //             return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
    //         }

    //         if (now()->greaterThan($otpRecord->expires_at)) {
    //             return response()->json(['success' => false, 'message' => 'OTP has expired.']);
    //         }

    //         // Retrieve user data from session
    //         $userData = $request->session()->get('user_data');

    //         if (!$userData || $userData['email'] != $request->email) {
    //             return response()->json(['success' => false, 'message' => 'Session data not found or mismatch.']);
    //         }

    //         // Create the user
    //         $user = User::create([
    //             'name' => $userData['name'],
    //             'email' => $userData['email'],
    //             'mobile' => $userData['mobile'],
    //         ]);

    //         // Log in the user
    //         Auth::login($user);


    //         // Delete OTP record
    //         $otpRecord->delete();

    //         // Clear session data
    //         $request->session()->forget('user_data');
    //         if ($user->isHirer == 1) {
    //             return redirect()->intended('/home-hirer');
    //         } else {
    //             return redirect()->intended('/add-candidate');
    //         }

    //         return response()->json(['success' => true, 'message' => 'Registration and Login successful.']);
    //     }
    // }


    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'contact' => 'required|digits:10|unique:users,contact',
        'gender' => 'required|in:male,female,other',
        'education_qualification' => 'required|string|max:255',
        'dob' => 'required|date|before_or_equal:today',
    ], [
        'email.unique' => 'The email address is already taken.',
        'contact.unique' => 'The contact number is already in use.',
        'contact.digits' => 'The contact number must be exactly 10 digits.',
        'dob.date' => 'The date of birth must be a valid date.',
    ]);

    // Generate OTP
    $otp = rand(100000, 999999); // 6-digit OTP

    // Store user data and OTP in session
    $userData = $request->only(['name', 'email', 'contact', 'gender', 'dob', 'education_qualification']);
    $userData['otp'] = $otp;
    $userData['otp_expires_at'] = Carbon::now()->addMinutes(10); // OTP expires in 10 minutes
    $request->session()->put('user_data', $userData);

    // Send OTP via email
    try {
        Mail::raw("Your OTP for registration is: $otp", function ($message) use ($userData) {
            $message->to($userData['email'])
                ->subject('Your OTP for Registration');
        });

        // Redirect to OTP verification page
        return redirect()->route('auth.register')->with([
            'showModal' => true,
            'email' => $userData['email'],
        ])->with('success', 'OTP sent successfully. Please check your email.');
    } catch (\Exception $e) {
        // In case of an error sending the OTP 
        return back()->with('error', 'Failed to send OTP. Please try again.');
    }
}


    // OTP verification for registration
    public function verifyOtpRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);
    
        $userData = $request->session()->get('user_data');
    
        // Ensure session data exists and matches the input email
        if (!$userData || $userData['email'] !== $request->input('email')) {
            return redirect()->back()->with('error', 'Invalid session data. Please restart the registration process.');
        }
    
        $otp = $request->input('otp');
        // dd($userData['name']);
        // Check if the OTP matches and is not expired
        if ($userData['otp'] == $otp && Carbon::now()->lessThan($userData['otp_expires_at'])) {
            // dd("testing otp");
            // Create the user in the database
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'contact' => $userData['contact'],
                'dob' => $userData['dob'],
                'gender' => $userData['gender'],
                'education_qualification' => $userData['education_qualification'],
                'email_verified_at' => Carbon::now(),
            ]);
    
            // Clear session data
            $request->session()->forget('user_data');
    
            return redirect()->route('auth.login')->with('success', 'Registration successful. Your account is now verified.');
        } else {
            // Clear session data on failure
            $request->session()->forget('user_data');
            // dd('rtyuio');
    
            return redirect()->back()->with('error', 'Invalid OTP or OTP expired. Registration failed.');
        }
    }
    

    // logout method
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'You have been logged out.');
    }
}
