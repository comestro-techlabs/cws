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
            $googleUser = Socialite::driver('googleAuth')->scopes(['openid', 'profile', 'email'])
            ->user();
            \Log::info('Google User: ', (array) $googleUser);

            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'image' => $googleUser->getAvatar(),
                    'isAdmin' => 0,
                    'google_id' => $googleUser->getId(),
                    'password' => '123456dummy', // Consider hashing this
                ]);
                Auth::login($newUser);
                // Send email to the user
                Mail::to($newUser->email)->send(new UserRegisterMail($newUser));
            }
            session(['user_avatar' => $googleUser->getAvatar()]);

            return redirect()->intended(Auth::user()->isAdmin == 1 ? '/v2/admin/dashboard' : '/');
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            $this->errorMessage = 'Unable to login with Google, please try again.';
        }
    }
    public function render()
    {
        return view('livewire.auth.google-login');
    }
}
