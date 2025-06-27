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
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname(), 
                    'email' => $googleUser->getEmail(),
                    'image' => $googleUser->getAvatar(),
                    'isAdmin' => 0,
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('123456dummy'),
                ]);
                Auth::login($newUser);
                 // Send email to the user
                 Mail::to($newUser->email)->send(new UserRegisterMail($newUser));
            }
            session(['user_avatar' => $googleUser->getAvatar()]);

            return redirect()->intended(Auth::user()->isAdmin == 1 ? '/v2/admin/dashboard' : '/');
        } catch (\Exception $e) {
            \Log::error('google login error: ' . $e->getMessage());
            $this->errorMessage = 'Unable to login with google, please try again.';
            return null; 
        }
    }
    public function render()
    {
        return view('livewire.auth.google-login');
    }
}
