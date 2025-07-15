<?php

namespace App\Livewire\Auth;

use App\Mail\UserRegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class GoogleLogin extends Component
{
    public $errorMessage = '';

    // Method to initiate Google login
    public function redirectToGoogle() 
    {
        $redirectUrl = config('services.googleAuth.redirect');
        \Log::info('Redirecting to Google. Current GOOGLE_REDIRECT_URI:', [
            'GOOGLE_REDIRECT_URI' => $redirectUrl
        ]);
       
        return redirect()->to(Socialite::driver('googleAuth')->redirect()->getTargetUrl());
    }
    
    public function handleGoogleCallback() 
    {
        try {
            
            $googleUser = Socialite::driver('googleAuth')->stateless()->user();
            \Log::info('google User: ', (array) $googleUser);

            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Update existing user with Google ID if not set
                if (!$existingUser->google_id) {
                    $existingUser->update(['google_id' => $googleUser->getId()]);
                }
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname(), 
                    'email' => $googleUser->getEmail(),
                    'image' => $googleUser->getAvatar(),
                    'isAdmin' => 0,
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('123456dummy'),
                    'email_verified_at' => now(), // Mark email as verified since it's verified by Google
                ]);
                Auth::login($newUser);
                
                // Try to send email, but don't fail if it doesn't work
                try {
                    Mail::to($newUser->email)->send(new UserRegisterMail($newUser));
                } catch (\Exception $mailException) {
                    \Log::warning('Failed to send registration email: ' . $mailException->getMessage());
                    // Continue with login process even if email fails
                }
            }
            
            session(['user_avatar' => $googleUser->getAvatar()]);

            return redirect()->intended(Auth::user()->isAdmin == 1 ? '/v2/admin/dashboard' : '/');
        } catch (\Exception $e) {
            \Log::error('google login error: ' . $e->getMessage());
            $this->errorMessage = 'Unable to login with google, please try again.';
            return redirect()->route('auth.login')->with('error', $this->errorMessage);
        }
    }
    public function render()
    {
        return view('livewire.auth.google-login');
    }
}
