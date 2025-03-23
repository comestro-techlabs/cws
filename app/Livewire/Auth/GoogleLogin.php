<?php

namespace App\Livewire\Auth;

use App\Mail\UserRegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;
class GoogleLogin extends Component
{
    public $errorMessage = '';

    // Method to initiate Google login
    public function redirectToGoogle()
    {
        return redirect()->to(Socialite::driver('googleAuth')->redirect()->getTargetUrl());
    }

    // This will be called after the callback in a view or route
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('googleAuth')
                ->stateless() // Add stateless to prevent session issues
                ->user();

            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser, true);
                session(['user_avatar' => $googleUser->getAvatar()]);

                return redirect()->intended(
                    Auth::user()->isAdmin ? '/v2/admin/dashboard' : '/'
                );
            }

            $newUser = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'image' => $googleUser->getAvatar(),
                'isAdmin' => 0,
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
            ]);

            Auth::login($newUser, true);
            session(['user_avatar' => $googleUser->getAvatar()]);

            // Send welcome email asynchronously
            try {
                Mail::to($newUser->email)->queue(new UserRegisterMail($newUser));
            } catch (\Exception $e) {
                \Log::error('Failed to send welcome email: ' . $e->getMessage());
            }

            return redirect()->intended('/');

        } catch (\Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            session()->flash('error', 'Unable to login with Google. Please try again.');
            return redirect()->route('auth.login');
        }
    }
    public function render()
    {
        return view('livewire.auth.google-login');
    }
}
